@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            destroy: true,
            columnDefs: [
                { orderable: false, searchable: false, targets: [9] },
                { orderable: false, targets: [8] },
            ]
        });
    });
</script>
@endpush

@section('title', 'Rent Requests')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Rent Requests</h1>
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
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Type</th>
                                <th>Pickup Date</th>
                                <th>Drop Date</th>
                                <th>Delivery</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}<br><small class="text-muted">{{ $item->user->email }}</small></td>
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
                                    <td>
                                        @if ($item->status === 'pending')
                                            <form action="{{ route('rentDetails.approve', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('rentDetails.reject', $item->id) }}" method="POST" class="d-inline ml-1">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-times"></i> Reject
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">—</span>
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
