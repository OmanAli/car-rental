<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CarController extends Controller
{
    /**
     * Spreadsheet header text (lowercased, whitespace-collapsed) mapped to the Car field it fills.
     * Any column not listed here (e.g. "Car Type") is simply ignored on import.
     */
    private const IMPORT_HEADER_MAP = [
        'make' => 'make',
        'model' => 'model',
        'year' => 'year',
        'doors' => 'doors',
        'transmission' => 'transmission',
        'passenger' => 'passengers',
        'passengers' => 'passengers',
        'daily rate' => 'rent_per_day',
        'daily rates' => 'rent_per_day',
        'weekly rate' => 'weekly_rate',
        'weekly rates' => 'weekly_rate',
        'uber/lyft weekly rate' => 'uber_lyft_weekly_rate',
        'uber/lyft weekly rates' => 'uber_lyft_weekly_rate',
        'registration number' => 'registration_number',
        'registration' => 'registration_number',
        'reg number' => 'registration_number',
    ];

    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }
    public function create()
    {
        return view('cars.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'registration_number' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'year' => ['required'],
            'rent_per_day' => ['required', 'numeric', 'min:0'],
            'weekly_rate' => ['required', 'numeric', 'min:0'],
            'uber_lyft_weekly_rate' => ['nullable', 'numeric', 'min:0'],
            'doors' => ['required', 'integer', 'min:1'],
            'passengers' => ['required', 'integer', 'min:1'],
            'transmission' => ['required'],
            'luggage' => ['nullable', 'string'],
            'air_condition' => ['nullable', 'in:0,1'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        try {
            DB::beginTransaction();

            $imagePath = $this->storeCarImage($request);

            Car::create([
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'registration_number' => $request->registration_number,
                'rental_price_per_day' => $request->rent_per_day,
                'weekly_rate' => $request->weekly_rate,
                'uber_lyft_weekly_rate' => $request->uber_lyft_weekly_rate,
                'doors' => $request->doors,
                'passengers' => $request->passengers,
                'transmission' => $request->transmission,
                'luggage' => $request->luggage,
                'air_condition' => $request->boolean('air_condition'),
                'image' => $imagePath,
            ]);
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Data Inserted Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        $sheet = IOFactory::load($request->file('file')->getRealPath())->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, false);
        $header = array_map(fn ($cell) => $this->normalizeImportHeader((string) $cell), array_shift($rows) ?? []);

        $columns = [];
        foreach ($header as $index => $label) {
            if (isset(self::IMPORT_HEADER_MAP[$label])) {
                $columns[self::IMPORT_HEADER_MAP[$label]] = $index;
            }
        }

        $imported = 0;
        $skipped = [];

        try {
            DB::beginTransaction();

            foreach ($rows as $rowNumber => $row) {
                $cell = fn (string $field) => isset($columns[$field], $row[$columns[$field]])
                    ? trim((string) $row[$columns[$field]])
                    : null;

                $make = $cell('make');
                $model = $cell('model');

                // Skip a fully blank row.
                if (!$make && !$model) {
                    continue;
                }

                $year = $cell('year');
                $dailyRate = $this->parseImportRate($cell('rent_per_day'));
                $weeklyRate = $this->parseImportRate($cell('weekly_rate'));

                if (!$make || !$model || !$year || $dailyRate === null || $weeklyRate === null) {
                    $skipped[] = 'Row ' . ($rowNumber + 2) . ' (' . ($make ?: '—') . ' ' . ($model ?: '—') . '): missing make, model, year, daily rate, or weekly rate.';
                    continue;
                }

                Car::create([
                    'make' => $make,
                    'model' => $model,
                    'year' => $year,
                    'registration_number' => $cell('registration_number') ?: $this->generateImportRegistrationNumber(),
                    'rental_price_per_day' => $dailyRate,
                    'weekly_rate' => $weeklyRate,
                    'uber_lyft_weekly_rate' => $this->parseImportRate($cell('uber_lyft_weekly_rate')),
                    'doors' => $cell('doors') ?: null,
                    'passengers' => $cell('passengers') ?: null,
                    'transmission' => $this->normalizeImportTransmission($cell('transmission')),
                ]);
                $imported++;
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

        if ($imported === 0) {
            return back()->with('error', 'No cars were imported. ' . ($skipped[0] ?? 'The file has no recognizable data rows.'));
        }

        $message = "Imported {$imported} car(s) successfully!";
        if ($skipped) {
            $message .= ' ' . count($skipped) . ' row(s) skipped: ' . implode(' ', array_slice($skipped, 0, 5))
                . (count($skipped) > 5 ? ' (+' . (count($skipped) - 5) . ' more)' : '');
        }

        return redirect()->route('cars.index')->with('success', $message);
    }

    private function normalizeImportHeader(string $value): string
    {
        $value = trim(preg_replace('/\s+/', ' ', strtolower($value)));

        // Strip a stray leading list number some spreadsheets prefix onto the first header (e.g. "1 Make").
        return preg_replace('/^\d+[.)]?\s*/', '', $value);
    }

    private function normalizeImportTransmission(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        $lower = strtolower($value);
        if (str_starts_with($lower, 'auto')) {
            return 'Auto';
        }
        if (str_starts_with($lower, 'manual')) {
            return 'Manual';
        }

        return $value;
    }

    private function parseImportRate(?string $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (in_array(strtoupper($value), ['N/A', 'NA', '-'], true)) {
            return null;
        }

        $clean = preg_replace('/[^0-9.\-]/', '', $value);

        return $clean === '' ? null : (float) $clean;
    }

    private function generateImportRegistrationNumber(): string
    {
        do {
            $candidate = 'PENDING-' . strtoupper(Str::random(6));
        } while (Car::where('registration_number', $candidate)->exists());

        return $candidate;
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'registration_number' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'year' => ['required'],
            'rent_per_day' => ['required', 'numeric', 'min:0'],
            'weekly_rate' => ['required', 'numeric', 'min:0'],
            'uber_lyft_weekly_rate' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required'],
            'doors' => ['required', 'integer', 'min:1'],
            'passengers' => ['required', 'integer', 'min:1'],
            'transmission' => ['required'],
            'luggage' => ['nullable', 'string'],
            'air_condition' => ['nullable', 'in:0,1'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        try {
            DB::beginTransaction();
            $car = Car::findOrFail($id);

            $payload = [
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'registration_number' => $request->registration_number,
                'rental_price_per_day' => $request->rent_per_day,
                'weekly_rate' => $request->weekly_rate,
                'uber_lyft_weekly_rate' => $request->uber_lyft_weekly_rate,
                'status' => $request->status,
                'doors' => $request->doors,
                'passengers' => $request->passengers,
                'transmission' => $request->transmission,
                'luggage' => $request->luggage,
                'air_condition' => $request->boolean('air_condition'),
            ];

            if ($request->hasFile('image')) {
                $this->deleteCarImage($car->image);
                $payload['image'] = $this->storeCarImage($request);
            }

            $car->update($payload);
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $car = Car::findOrFail($id);
            $this->deleteCarImage($car->image);
            $car->delete();
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car Deleted Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    private function storeCarImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $filename = uniqid('car_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/cars'), $filename);

        return 'uploads/cars/' . $filename;
    }

    private function deleteCarImage(?string $path): void
    {
        if (!$path) {
            return;
        }
        $full = public_path($path);
        if (file_exists($full)) {
            @unlink($full);
        }
    }
}
