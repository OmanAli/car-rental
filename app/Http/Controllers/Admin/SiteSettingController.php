<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    public function index(Request $request)
    {
        $pages = config('site_content.pages');
        $pageKey = $request->query('page', array_key_first($pages));

        abort_unless(isset($pages[$pageKey]), 404);

        $values = SiteSetting::allValues();

        return view('settings.index', compact('pages', 'pageKey', 'values'));
    }

    public function update(Request $request, $page)
    {
        $pages = config('site_content.pages');
        abort_unless(isset($pages[$page]), 404);

        $request->validate([
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        // Field definitions for this page only.
        $fields = [];
        foreach ($pages[$page]['sections'] as $section) {
            $fields += $section['fields'];
        }

        // Keys contain dots, so read the raw arrays instead of dot-notation lookups.
        $texts = $request->input('settings', []);
        $images = $request->file('images', []);

        try {
            DB::beginTransaction();

            foreach ($fields as $key => $field) {
                if ($field['type'] === 'image') {
                    if (isset($images[$key])) {
                        $old = SiteSetting::where('key', $key)->value('value');
                        $this->storeSetting($key, $this->storeImage($images[$key]));
                        $this->deleteUploadedImage($old);
                    }
                } elseif (array_key_exists($key, $texts)) {
                    $this->storeSetting($key, trim((string) $texts[$key]));
                }
            }

            DB::commit();
            SiteSetting::flushCache();

            return redirect()->route('settings.index', ['page' => $page])
                ->with('success', $pages[$page]['label'] . ' content updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    private function storeSetting(string $key, ?string $value): void
    {
        if ($value === null || $value === '') {
            // Blank means "use the default" - drop the override.
            SiteSetting::where('key', $key)->delete();
            return;
        }

        SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    private function storeImage($file): string
    {
        $filename = uniqid('setting_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/settings'), $filename);

        return 'uploads/settings/' . $filename;
    }

    private function deleteUploadedImage(?string $path): void
    {
        // Only remove files we uploaded; never touch the theme's default assets.
        if (!$path || !str_starts_with($path, 'uploads/settings/')) {
            return;
        }
        $full = public_path($path);
        if (file_exists($full)) {
            @unlink($full);
        }
    }
}
