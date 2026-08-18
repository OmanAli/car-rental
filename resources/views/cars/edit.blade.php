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
                <form method="POST" enctype="multipart/form-data" action="{{ route('cars.update', $car->id) }}">
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
                                <span style="color:red;">*</span>Daily Rate</label>
                                <input type="number" step="0.01" min="0"
                                    class="form-control form-control-contact @error('rent_per_day') is-invalid @enderror"
                                    placeholder="e.g. 70" name="rent_per_day"
                                    value="{{ old('rent_per_day', $car->rental_price_per_day) }}" required>

                                @error('rent_per_day')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Weekly Rate --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Weekly Rate</label>
                                <input type="number" step="0.01" min="0"
                                    class="form-control form-control-contact @error('weekly_rate') is-invalid @enderror"
                                    placeholder="e.g. 425" name="weekly_rate"
                                    value="{{ old('weekly_rate', $car->weekly_rate) }}" required>

                                @error('weekly_rate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Uber/Lyft Weekly Rate --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                Uber/Lyft Weekly Rate <small class="text-muted">(optional)</small>
                                <input type="number" step="0.01" min="0"
                                    class="form-control form-control-contact @error('uber_lyft_weekly_rate') is-invalid @enderror"
                                    placeholder="e.g. 425" name="uber_lyft_weekly_rate"
                                    value="{{ old('uber_lyft_weekly_rate', $car->uber_lyft_weekly_rate) }}">

                                @error('uber_lyft_weekly_rate')
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

                            {{-- Doors --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Doors</label>
                                <input type="number" min="1"
                                    class="form-control form-control-contact @error('doors') is-invalid @enderror"
                                    placeholder="4" name="doors" value="{{ old('doors', $car->doors) }}" required>

                                @error('doors')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Passengers --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Passengers</label>
                                <input type="number" min="1"
                                    class="form-control form-control-contact @error('passengers') is-invalid @enderror"
                                    placeholder="5" name="passengers" value="{{ old('passengers', $car->passengers) }}" required>

                                @error('passengers')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Transmission --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Transmission</label>
                                <select name="transmission"
                                    class="form-control form-control-contact @error('transmission') is-invalid @enderror" required>
                                    <option value="" disabled>--Transmission--</option>
                                    <option value="Auto" {{ old('transmission', $car->transmission) == 'Auto' ? 'selected' : '' }}>Auto</option>
                                    <option value="Manual" {{ old('transmission', $car->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                </select>

                                @error('transmission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Luggage --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                Luggage <small class="text-muted">(optional)</small>
                                <input type="text"
                                    class="form-control form-control-contact @error('luggage') is-invalid @enderror"
                                    placeholder="2 Bags" name="luggage" value="{{ old('luggage', $car->luggage) }}">

                                @error('luggage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Air Condition --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                Air Condition <small class="text-muted">(optional)</small>
                                <select name="air_condition"
                                    class="form-control form-control-contact @error('air_condition') is-invalid @enderror">
                                    <option value="" {{ old('air_condition', $car->air_condition) === null ? 'selected' : '' }}>--Air Condition--</option>
                                    <option value="1" {{ (string) old('air_condition', $car->air_condition) === '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ (string) old('air_condition', $car->air_condition) === '0' ? 'selected' : '' }}>No</option>
                                </select>

                                @error('air_condition')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <label>Car Image</label>
                                @if ($car->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($car->image) }}" alt="Car"
                                            style="max-height:80px;border-radius:4px;">
                                    </div>
                                @endif
                                <input type="file" accept="image/*"
                                    class="form-control form-control-contact @error('image') is-invalid @enderror"
                                    name="image">
                                <small class="text-muted">Leave empty to keep current. JPG, PNG or WEBP. Max 4MB.</small>

                                @error('image')
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
