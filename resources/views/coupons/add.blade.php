@extends('layouts.app')

@section('title', 'Add Coupon')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Add Coupon</h1>
        </div>

        @include('common.alert')

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('coupons.store') }}">
                    @csrf
                    <div class="card-body">
                        <p class="text-muted">The coupon code is generated automatically by the system once saved.</p>
                        <div class="form-group row">

                            <div class="col-sm-6 mb-3 mt-3">
                                <span style="color:red;">*</span> Discount Percentage
                                <input type="number" name="percentage" step="0.01" min="1" max="100"
                                    class="form-control @error('percentage') is-invalid @enderror"
                                    placeholder="e.g. 10" value="{{ old('percentage') }}" required>
                                @error('percentage')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right mb-3">Save</button>
                        <a href="{{ route('coupons.index') }}" class="btn btn-primary float-right mr-3 mb-3">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
