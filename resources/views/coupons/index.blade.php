@extends('layouts.app')

@section('title', 'Coupons')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Coupons</h1>
            <a href="{{ route('coupons.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus fa-sm"></i> Add Coupon
            </a>
        </div>

        @include('common.alert')

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Discount %</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ rtrim(rtrim(number_format($coupon->percentage, 2), '0'), '.') }}%</td>
                                    <td>
                                        @if ($coupon->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td style="display:flex;">
                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-primary btn-sm m-1">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        @if ($coupon->is_active)
                                            <form action="{{ route('coupons.disable', $coupon->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm m-1" title="Deactivate">
                                                    <i class="fa fa-ban"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('coupons.enable', $coupon->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm m-1" title="Activate">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
