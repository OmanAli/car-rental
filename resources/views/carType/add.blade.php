@extends('layouts.app')

@section('title', 'Car Type')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Car Type</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">
                <form method="POST" encrypt="multipart-encrypt" action="{{ route('carType.store') }}">
                    @csrf
                    <div class="form-group row">
                        {{-- Make --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        </div>
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <div class="card-body">
                                <span style="color:red;">*</span>Car Type</label>
                                <input type="text"
                                    class="form-control form-control-contact @error('make') is-invalid @enderror"
                                    id="exampleMake" placeholder="Sports,Luxury etc" name="carType" value="{{ old('carType') }}"
                                    required>

                                @error('carType')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="card-footer mt-2">
                                <button type="submit" class="btn btn-success float-right btn-contact mb-3">Save</button>

                                <a class="btn btn-primary mr-3 mb-3 float-right" href="{{route('carType.create')}}">Cancel</a>

                            </div>
                        </div>
                         <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
