@extends('layouts.app')

@section('title', 'My Requests')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">My Requests</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Car</th>
                                <th>Type</th>
                                <th>Pickup Date</th>
                                <th>Drop Date</th>
                                <th>Delivery</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->car->make }} {{ $item->car->model }} ({{ $item->car->year }})</td>
                                    <td>{{ $item->car->carType->name }}</td>
                                    <td>{{ $item->pickup_date }}</td>
                                    <td>{{ $item->drop_date }}</td>
                                    <td>
                                        @if ($item->delivery_type === 'delivery')
                                            <span class="badge badge-info">Delivery</span>
                                        @else
                                            <span class="badge badge-secondary">Self Pickup</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->delivery_location ?? '—' }}</td>
                                    <td>
                                        @if ($item->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($item->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
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
