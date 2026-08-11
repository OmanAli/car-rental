<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentDetail;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class VeteranDiscountController extends Controller
{
    public function index()
    {
        $percentage = SiteSetting::getValue(RentDetail::VETERAN_DISCOUNT_SETTING_KEY, '0');
        return view('veteranDiscounts.index', compact('percentage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'percentage' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        SiteSetting::updateOrCreate(
            ['key' => RentDetail::VETERAN_DISCOUNT_SETTING_KEY],
            ['value' => $request->percentage]
        );
        SiteSetting::flushCache();

        return redirect()->route('veteranDiscounts.index')->with('success', 'Veteran discount percentage updated successfully!');
    }
}
