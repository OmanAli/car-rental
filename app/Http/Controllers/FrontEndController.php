<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function welcome()
    {
        $cars = Car::where('status', 1)->get();
        return view('frontend.welcome', compact('cars'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function services()
    {
        $cars = Car::where('status', 1)->get();
        return view('frontend.services', compact('cars'));
    }
    public function service_details()
    {
        return view('frontend.service_detail');
    }

    public function cars()
    {
        $cars = Car::where('status', 1)->get();
        return view('frontend.cars', compact('cars'));
    }

    public function car_details(Car $car)
    {
        return view('frontend.car_detail', compact('car'));
    }

    public function contact(){
        return view('frontend.contact');
    }
}
