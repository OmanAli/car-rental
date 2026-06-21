@extends('layouts.app')

@section('title', 'Add User')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
        </div>

        @include('common.alert')

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Name
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Full Name" value="{{ old('name') }}" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Email
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email@example.com" value="{{ old('email') }}" required>
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Password
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Min 8 characters" required>
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Confirm Password
                                <input type="password" name="password_confirmation"
                                    class="form-control"
                                    placeholder="Repeat password" required>
                            </div>

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Role
                                <select name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="" disabled selected>--Select Role--</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                                @error('role')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right mb-3">Save</button>
                        <a href="{{ route('users.index') }}" class="btn btn-primary float-right mr-3 mb-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
