<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }
    public function services()
    {
        return view('frontend.services');
    }
    public function service_details()
    {
        return view('frontend.service_detail');
    }

    public function cars()
    {
        return view('frontend.cars');
    }

    public function car_details()
    {
        return view('frontend.car_detail');
    }

    public function contact(){
        return view('frontend.contact');
    }
}
