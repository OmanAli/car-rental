<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupons.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'percentage' => ['required', 'numeric', 'min:1', 'max:100'],
        ]);

        try {
            DB::beginTransaction();
            $coupon = Coupon::create([
                'code'       => $this->generateUniqueCode(),
                'percentage' => $request->percentage,
                'is_active'  => true,
            ]);
            DB::commit();
            return redirect()->route('coupons.index')->with('success', "Coupon {$coupon->code} created successfully!");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    protected function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Coupon::where('code', $code)->exists());

        return $code;
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'percentage' => ['required', 'numeric', 'min:1', 'max:100'],
        ]);

        try {
            DB::beginTransaction();
            $coupon = Coupon::findOrFail($id);
            $coupon->update([
                'percentage' => $request->percentage,
            ]);
            DB::commit();
            return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function disable($id)
    {
        try {
            DB::beginTransaction();
            Coupon::findOrFail($id)->update(['is_active' => false]);
            DB::commit();
            return back()->with('success', 'Coupon disabled successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function enable($id)
    {
        try {
            DB::beginTransaction();
            Coupon::findOrFail($id)->update(['is_active' => true]);
            DB::commit();
            return back()->with('success', 'Coupon enabled successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
