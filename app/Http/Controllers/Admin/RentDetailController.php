<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentDetailController extends Controller
{
    public function index()
    {
        $requests = RentDetail::with(['user', 'car.carType', 'coupon'])->latest()->get();
        return view('rentDetails.index', compact('requests'));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();
            RentDetail::findOrFail($id)->update(['status' => 'approved']);
            DB::commit();
            return back()->with('success', 'Rental request approved successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            DB::beginTransaction();
            RentDetail::findOrFail($id)->update(['status' => 'rejected']);
            DB::commit();
            return back()->with('success', 'Rental request rejected.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
