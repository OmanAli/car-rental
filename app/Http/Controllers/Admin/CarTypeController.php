<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarTypeController extends Controller
{
    public function index()
    {
        $cars = CarType::all();
        return view('carType.index', compact('cars'));
        // $request->validate([
        //     'current_password' => ['required', new MatchOldPassword],
        //     'new_password' => ['required'],
        //     'new_confirm_password' => ['same:new_password'],
        // ]);

        // try {
        //     DB::beginTransaction();
        //     DB::table('users')->whereId(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        //     DB::commit();
        //     return back()->with('success', 'Password Changed Successfully.');
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return back()->with('error', $th->getMessage());
        // }
    }
    public function create()
    {
        return view('carType.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'carType' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            CarType::create([
                'name' => $request->carType,
            ]);
            DB::commit();
            return redirect()->route('carType.index')->with('success', 'Data Inserted Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'carType' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            CarType::where('id', $request->id)->update([
                'name' => $request->carType,
            ]);
            DB::commit();
            return redirect()->route('carType.index')->with('success', 'Data Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
