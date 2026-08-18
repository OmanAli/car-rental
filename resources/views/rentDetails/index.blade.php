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

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.request-details-btn');
        if (!btn) return;
        var d = btn.dataset;

        document.getElementById('rdCustomer').textContent = d.customer + ' (' + d.email + ')';
        document.getElementById('rdCar').textContent = d.car;
        document.getElementById('rdPickup').textContent = d.pickup;
        document.getElementById('rdDrop').textContent = d.drop;
        document.getElementById('rdDelivery').textContent = d.delivery === 'Delivery' && d.location !== '—'
            ? d.delivery + ' — ' + d.location
            : d.delivery;
        document.getElementById('rdRentalType').textContent = d.rentalType;
        document.getElementById('rdAmount').textContent = '$' + d.amount;

        var discountRow = document.getElementById('rdDiscountRow');
        if (d.discountType) {
            document.getElementById('rdDiscountType').textContent = d.discountType + ': ' + d.discountReference;
            document.getElementById('rdDiscountedAmount').textContent = '$' + d.discountedAmount;
            discountRow.style.display = '';
        } else {
            discountRow.style.display = 'none';
        }

        document.getElementById('rdStatus').textContent = d.status;
        new bootstrap.Modal(document.getElementById('requestDetailsModal')).show();
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
                                <th>Pickup Date</th>
                                <th>Drop Date</th>
                                <th>Delivery</th>
                                <th>Location</th>
                                <th>Discount</th>
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
                                        @if ($item->discount_type)
                                            <span class="badge badge-info">{{ $item->discount_type }}</span>
                                            <small class="d-block text-muted">{{ $item->discount_reference }}</small>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($item->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <button type="button" class="btn btn-info btn-sm request-details-btn"
                                            title="Details"
                                            data-customer="{{ $item->user->name }}"
                                            data-email="{{ $item->user->email }}"
                                            data-car="{{ $item->car->make }} {{ $item->car->model }} ({{ $item->car->year }})"
                                            data-pickup="{{ $item->pickup_date }}"
                                            data-drop="{{ $item->drop_date }}"
                                            data-delivery="{{ $item->delivery_type === 'delivery' ? 'Delivery' : 'Self Pickup' }}"
                                            data-location="{{ $item->delivery_location ?? '—' }}"
                                            data-rental-type="{{ $item->rental_type_label }}"
                                            data-amount="{{ number_format($item->amount, 2) }}"
                                            data-discount-type="{{ $item->discount_type }}"
                                            data-discount-reference="{{ $item->discount_reference }}"
                                            data-discounted-amount="{{ number_format($item->discounted_amount, 2) }}"
                                            data-status="{{ ucfirst($item->status) }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        @if ($item->status === 'pending')
                                            <form action="{{ route('rentDetails.approve', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Approve">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('rentDetails.reject', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Reject">
                                                    <i class="fa fa-times"></i>
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

        <!-- Request Details Modal -->
        <div class="modal fade" id="requestDetailsModal" tabindex="-1" aria-labelledby="requestDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestDetailsModalLabel">Request Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tbody>
                                <tr><th width="40%">Customer</th><td id="rdCustomer"></td></tr>
                                <tr><th>Car</th><td id="rdCar"></td></tr>
                                <tr><th>Pickup Date</th><td id="rdPickup"></td></tr>
                                <tr><th>Drop Date</th><td id="rdDrop"></td></tr>
                                <tr><th>Delivery</th><td id="rdDelivery"></td></tr>
                                <tr><th>Rental Type</th><td id="rdRentalType"></td></tr>
                                <tr><th>Amount</th><td id="rdAmount"></td></tr>
                                <tr id="rdDiscountRow">
                                    <th>Discount</th>
                                    <td>
                                        <span id="rdDiscountType"></span>
                                        <strong class="d-block text-success" id="rdDiscountedAmount"></strong>
                                    </td>
                                </tr>
                                <tr><th>Status</th><td id="rdStatus"></td></tr>
                            </tbody>
                        </table>
                        <p class="text-muted small mt-3 mb-0">
                            Discounted amounts are subject to the validity of the coupon/veteran ID used and will be finalized by management.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
