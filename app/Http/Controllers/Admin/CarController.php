<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }
    public function create()
    {
        $data = CarType::all();
        return view('cars.add', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'car_type' => ['required'],
            'registration_number' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'year' => ['required'],
            'rent_per_day' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            Car::create([
                'car_type_id' => $request->car_type,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'registration_number' => $request->registration_number,
                'rental_price_per_day' => $request->rent_per_day,
            ]);
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Data Inserted Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $data = CarType::all();
        return view('cars.edit', compact('car', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'car_type' => ['required'],
            'registration_number' => ['required'],
            'make' => ['required'],
            'model' => ['required'],
            'year' => ['required'],
            'rent_per_day' => ['required'],
            'status' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $car = Car::findOrFail($id);
            $car->update([
                'car_type_id' => $request->car_type,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'registration_number' => $request->registration_number,
                'rental_price_per_day' => $request->rent_per_day,
                'status' => $request->status,
            ]);
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
