<?php

namespace App\Http\Controllers;

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
        $requests = RentDetail::with(['car.carType'])
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
        ]);

        try {
            DB::beginTransaction();
            RentDetail::create([
                'user_id'           => auth()->id(),
                'car_id'            => $request->car_id,
                'pickup_date'       => Carbon::createFromFormat('m/d/Y', $request->pickup_date)->format('Y-m-d'),
                'drop_date'         => Carbon::createFromFormat('m/d/Y', $request->drop_date)->format('Y-m-d'),
                'delivery_type'     => $request->delivery_type,
                'delivery_location' => $request->delivery_location,
                'status'            => 'pending',
            ]);
            DB::commit();
            return back()->with('success', 'Rental request submitted successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
