@extends('layouts.app')

@section('title', 'Veteran Discount')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Veteran Discount</h1>
        </div>

        @include('common.alert')

        <div class="row">
            <div class="col-md-12">
                <p class="text-muted">Veteran IDs are provided by customers themselves at booking time and are not
                    verified individually. Set the single discount percentage that applies whenever a customer
                    enters a veteran ID.</p>

                <form method="POST" action="{{ route('veteranDiscounts.update') }}">
                    @csrf
                    <div class="card-body px-0">
                        <div class="form-group row">

                            <div class="col-sm-4 mb-3 mt-3">
                                <span style="color:red;">*</span> Discount Percentage
                                <input type="number" name="percentage" step="0.01" min="0" max="100"
                                    class="form-control @error('percentage') is-invalid @enderror"
                                    placeholder="e.g. 10" value="{{ old('percentage', $percentage) }}" required>
                                @error('percentage')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer px-0">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
