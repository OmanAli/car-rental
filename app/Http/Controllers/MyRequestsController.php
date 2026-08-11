<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\RentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $requests = RentDetail::with(['car.carType', 'coupon'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('myRequests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id'            => ['required', 'exists:cars,id'],
            'pickup_date'       => ['required', 'date_format:m/d/Y', 'after_or_equal:today'],
            'drop_date'         => ['required', 'date_format:m/d/Y', 'after_or_equal:pickup_date'],
            'delivery_type'     => ['required', 'in:pickup,delivery'],
            'delivery_location' => ['required_if:delivery_type,delivery', 'nullable', 'string', 'max:255'],
            'coupon_code'       => ['nullable', 'string', 'max:50'],
            'veteran_id'        => ['nullable', 'string', 'max:50'],
        ]);

        if ($request->filled('coupon_code') && $request->filled('veteran_id')) {
            return back()->withErrors([
                'coupon_code' => 'You can only use one discount at a time — a coupon code or a veteran ID, not both.',
            ])->withInput();
        }

        $couponId = null;
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', strtoupper($request->coupon_code))->where('is_active', true)->first();
            if (!$coupon) {
                return back()->withErrors(['coupon_code' => 'This coupon code is invalid or no longer active.'])->withInput();
            }
            $couponId = $coupon->id;
        }

        try {
            DB::beginTransaction();
            RentDetail::create([
                'user_id'             => auth()->id(),
                'car_id'              => $request->car_id,
                'coupon_id'           => $couponId,
                'veteran_id'          => $request->veteran_id,
                'pickup_date'         => Carbon::createFromFormat('m/d/Y', $request->pickup_date)->format('Y-m-d'),
                'drop_date'           => Carbon::createFromFormat('m/d/Y', $request->drop_date)->format('Y-m-d'),
                'delivery_type'       => $request->delivery_type,
                'delivery_location'   => $request->delivery_location,
                'status'              => 'pending',
            ]);
            DB::commit();
            return back()->with('success', 'Rental request submitted successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
