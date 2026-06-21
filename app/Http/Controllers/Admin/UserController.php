<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->where('id', '!=', auth()->id())->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:admin,customer'],
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'is_active' => true,
            ]);
            $user->assignRole($request->role);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'role'  => ['required', 'in:admin,customer'],
        ]);

        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
            $user->syncRoles([$request->role]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function disable($id)
    {
        try {
            DB::beginTransaction();
            User::findOrFail($id)->update(['is_active' => false]);
            DB::commit();
            return back()->with('success', 'User disabled successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function enable($id)
    {
        try {
            DB::beginTransaction();
            User::findOrFail($id)->update(['is_active' => true]);
            DB::commit();
            return back()->with('success', 'User enabled successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
