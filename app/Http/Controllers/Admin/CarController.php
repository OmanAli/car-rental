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
            'doors' => ['required', 'integer', 'min:1'],
            'passengers' => ['required', 'integer', 'min:1'],
            'transmission' => ['required'],
            'luggage' => ['required'],
            'air_condition' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        try {
            DB::beginTransaction();

            $imagePath = $this->storeCarImage($request);

            Car::create([
                'car_type_id' => $request->car_type,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'registration_number' => $request->registration_number,
                'rental_price_per_day' => $request->rent_per_day,
                'doors' => $request->doors,
                'passengers' => $request->passengers,
                'transmission' => $request->transmission,
                'luggage' => $request->luggage,
                'air_condition' => $request->air_condition,
                'image' => $imagePath,
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
            'doors' => ['required', 'integer', 'min:1'],
            'passengers' => ['required', 'integer', 'min:1'],
            'transmission' => ['required'],
            'luggage' => ['required'],
            'air_condition' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        try {
            DB::beginTransaction();
            $car = Car::findOrFail($id);

            $payload = [
                'car_type_id' => $request->car_type,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'registration_number' => $request->registration_number,
                'rental_price_per_day' => $request->rent_per_day,
                'status' => $request->status,
                'doors' => $request->doors,
                'passengers' => $request->passengers,
                'transmission' => $request->transmission,
                'luggage' => $request->luggage,
                'air_condition' => $request->air_condition,
            ];

            if ($request->hasFile('image')) {
                $this->deleteCarImage($car->image);
                $payload['image'] = $this->storeCarImage($request);
            }

            $car->update($payload);
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $car = Car::findOrFail($id);
            $this->deleteCarImage($car->image);
            $car->delete();
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car Deleted Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    private function storeCarImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $filename = uniqid('car_', true) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/cars'), $filename);

        return 'uploads/cars/' . $filename;
    }

    private function deleteCarImage(?string $path): void
    {
        if (!$path) {
            return;
        }
        $full = public_path($path);
        if (file_exists($full)) {
            @unlink($full);
        }
    }
}
