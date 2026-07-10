@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            destroy: true,
            order: [],
        });
    });
</script>
@endpush

@section('title', 'Transactions')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Summary Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Revenue (Today)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($summary['today'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sun fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Revenue (This Week)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($summary['week'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Revenue (This Month)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($summary['month'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Revenue (This Year)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($summary['year'], 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Breakdown -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Breakdown</h6>
                <ul class="nav nav-pills">
                    @foreach (['daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly'] as $key => $label)
                        <li class="nav-item">
                            <a class="nav-link py-1 px-3 {{ $period === $key ? 'active' : '' }}"
                                href="{{ route('transactions.index', ['period' => $key]) }}">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Period</th>
                                <th>Transactions</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($breakdown as $row)
                                <tr>
                                    <td>{{ $row['label'] }}</td>
                                    <td>{{ $row['count'] }}</td>
                                    <td>${{ number_format($row['revenue'], 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No approved transactions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if ($breakdown->count())
                            <tfoot>
                                <tr class="font-weight-bold">
                                    <td>Total</td>
                                    <td>{{ $transactions->count() }}</td>
                                    <td>${{ number_format($transactions->sum->amount, 2) }}</td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <!-- All Transactions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Pickup Date</th>
                                <th>Drop Date</th>
                                <th>Days</th>
                                <th>Rate / Day</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>{{ $item->user->name }}<br><small class="text-muted">{{ $item->user->email }}</small></td>
                                    <td>{{ $item->car->make }} {{ $item->car->model }} ({{ $item->car->year }})</td>
                                    <td>{{ $item->pickup_date }}</td>
                                    <td>{{ $item->drop_date }}</td>
                                    <td>{{ $item->days }}</td>
                                    <td>${{ number_format($item->car->rental_price_per_day, 2) }}</td>
                                    <td>${{ number_format($item->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
