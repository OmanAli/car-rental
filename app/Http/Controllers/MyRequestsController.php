<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Coupon;
use App\Models\RentDetail;
use App\Models\SiteSetting;
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
        $requests = RentDetail::with(['car', 'coupon'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('myRequests.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id'            => ['required', 'exists:cars,id'],
            'rental_type'       => ['required', 'in:daily,weekly,uber_lyft_weekly'],
            'pickup_date'       => ['required', 'date_format:m/d/Y', 'after_or_equal:today'],
            'drop_date'         => ['required', 'date_format:m/d/Y', 'after_or_equal:pickup_date'],
            'delivery_type'     => ['required', 'in:pickup,delivery'],
            'delivery_location' => ['required_if:delivery_type,delivery', 'nullable', 'string', 'max:255'],
            'coupon_code'       => ['nullable', 'string', 'max:50'],
            'veteran_id'        => ['nullable', 'string', 'max:50'],
        ]);

        $car = Car::findOrFail($request->car_id);

        if ($request->rental_type === 'weekly' && $car->weekly_rate === null) {
            return back()->withErrors(['rental_type' => 'Weekly rate is not available for the selected car.'])->withInput();
        }
        if ($request->rental_type === 'uber_lyft_weekly' && $car->uber_lyft_weekly_rate === null) {
            return back()->withErrors(['rental_type' => 'Uber/Lyft weekly rate is not available for the selected car.'])->withInput();
        }

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
                'rental_type'         => $request->rental_type,
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

    /**
     * A fresh CSRF token for the booking-confirmation modal to swap into the form right
     * before the real submit, since the review step can leave the form open long enough
     * for the original token to go stale and trigger a 419 on submission.
     */
    public function refreshCsrfToken(Request $request)
    {
        return response()->json(['token' => $request->session()->token()]);
    }

    /**
     * Preview the discount percentage for a coupon code or veteran ID, for the
     * booking-confirmation modal. Read-only — final validation still happens in store().
     */
    public function previewDiscount(Request $request)
    {
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', strtoupper($request->coupon_code))->where('is_active', true)->first();
            return response()->json($coupon
                ? ['valid' => true, 'percentage' => (float) $coupon->percentage]
                : ['valid' => false]);
        }

        if ($request->filled('veteran_id')) {
            $percentage = (float) SiteSetting::getValue(RentDetail::VETERAN_DISCOUNT_SETTING_KEY, '0');
            return response()->json(['valid' => true, 'percentage' => $percentage]);
        }

        return response()->json(['valid' => false]);
    }
}
