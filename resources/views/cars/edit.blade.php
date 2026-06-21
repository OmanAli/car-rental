@extends('layouts.app')

@section('title', 'Edit Car')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Edit Car</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">
                <form method="POST" action="{{ route('cars.update', $car->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Car Registration Number</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('registration_number') is-invalid @enderror"
                                    placeholder="XYZ000" name="registration_number"
                                    value="{{ old('registration_number', $car->registration_number) }}" required>

                                @error('registration_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Car Type</label>
                                <select name="car_type"
                                    class="form-control form-control-contact @error('car_type') is-invalid @enderror">
                                    <option value="" disabled>--Car Type--</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}" {{ old('car_type', $car->car_type_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('car_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Make --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Make</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('make') is-invalid @enderror"
                                    placeholder="Honda, Toyota" name="make"
                                    value="{{ old('make', $car->make) }}" required>

                                @error('make')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Model</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('model') is-invalid @enderror"
                                    placeholder="Accord, Land Cruiser" name="model"
                                    value="{{ old('model', $car->model) }}" required>

                                @error('model')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Year --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Year</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('year') is-invalid @enderror"
                                    placeholder="2020" name="year"
                                    value="{{ old('year', $car->year) }}" required>

                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Rent Per Day --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Rent Per Day</label>
                                <input type="number"
                                    class="form-control form-control-contact @error('rent_per_day') is-invalid @enderror"
                                    placeholder="Rent" name="rent_per_day"
                                    value="{{ old('rent_per_day', $car->rental_price_per_day) }}" required>

                                @error('rent_per_day')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Status</label>
                                <select name="status"
                                    class="form-control form-control-contact @error('status') is-invalid @enderror">
                                    <option value="0" {{ old('status', $car->status) == 0 ? 'selected' : '' }}>Parked</option>
                                    <option value="1" {{ old('status', $car->status) == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="2" {{ old('status', $car->status) == 2 ? 'selected' : '' }}>Rented</option>
                                    <option value="3" {{ old('status', $car->status) == 3 ? 'selected' : '' }}>Maintenance</option>
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-contact float-right mb-3">Update</button>
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('cars.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
