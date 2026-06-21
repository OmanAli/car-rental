@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        </div>

        @include('common.alert')

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Name
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Full Name" value="{{ old('name', $user->name) }}" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Email
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email@example.com" value="{{ old('email', $user->email) }}" required>
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Role
                                <select name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="admin" {{ old('role', $user->roles->first()?->name) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="customer" {{ old('role', $user->roles->first()?->name) == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                                @error('role')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right mb-3">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-primary float-right mr-3 mb-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
