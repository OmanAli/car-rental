<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Car;
use App\Models\RentDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $monthlyRevenue = 0;
        $annualRevenue  = 0;
        $rentedCars     = 0;
        $pendingRequests = 0;

        if (auth()->user()->hasRole('admin')) {
            $monthlyRevenue = RentDetail::with('car')
                ->where('status', 'approved')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->get()
                ->sum->amount;

            $annualRevenue = RentDetail::with('car')
                ->where('status', 'approved')
                ->whereYear('created_at', now()->year)
                ->get()
                ->sum->amount;

            $rentedCars      = Car::where('status', 2)->count();
            $pendingRequests = RentDetail::where('status', 'pending')->count();
        }

        return view('home', compact('monthlyRevenue', 'annualRevenue', 'rentedCars', 'pendingRequests'));
    }
     public function getProfile()
    {
        return view('profile');
    }

      public function updateProfile(Request $request)
    {
        #Validations
        $request->validate([
            'name'    => 'required',
            'email'     => 'required|email',
            // 'mobile_number' => 'required|numeric|digits:10',
        ]);

        try {
            DB::beginTransaction();
            DB::table('users')->whereId(auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                // 'mobile_number' => $request->mobile_number,
            ]);
            DB::commit();
            return back()->with('success', 'Profile Updated Successfully.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();
            DB::table('users')->whereId(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            DB::commit();
            return back()->with('success', 'Password Changed Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
