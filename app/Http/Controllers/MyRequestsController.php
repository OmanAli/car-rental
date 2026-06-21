<?php

namespace App\Http\Controllers;

use App\Models\RentDetail;
use Illuminate\Http\Request;

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
}
