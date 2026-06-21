@extends('layouts.app')

@section('title', 'Cars')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Cars</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">
                <form method="POST" encrypt="multipart-encrypt" action="{{ route('cars.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">

                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Car Registration Number</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('registration_number') is-invalid @enderror"
                                    id="exampleMake" placeholder="XYZ000" name="registration_number" value="{{ old('registration_number') }}"
                                    required>

                                @error('registration_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Car Type</label>
                                <select name="car_type" id=""
                                    class="form-control form-control-contact @error('car_type') is-invalid @enderror">
                                    <option value="" selected disabled>--Car Type--</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    id="exampleMake" placeholder="Honda,Toyota" name="make" value="{{ old('make') }}"
                                    required>

                                @error('make')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Model</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('model') is-invalid @enderror"
                                    id="exampleModel" placeholder="Accord,Land Cruiser" name="model"
                                    value="{{ old('model') }}" required>

                                @error('model')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Year</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('email') is-invalid @enderror"
                                    id="exampleEmail" placeholder="Model:2020" name="year" value="{{ old('year') }}" required>

                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mobile Number --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                               <span style="color:red;">*</span>Rent Per Day</label>
                                <input type="number"
                                    class="form-control form-control-contact @error('rent_per_day') is-invalid @enderror"
                                    id="exampleMobile" placeholder="Rent" name="rent_per_day"
                                    value="{{ old('rent_per_day') }}" required>

                                @error('rent_per_day')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-contact float-right mb-3">Save</button>
                        <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('cars.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
