@extends('layouts.app')

@section('title', 'Cars')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Cars</h1>
            <div>
                <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus fa-sm"></i> Add Car
                </a>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#importCarsModal">
                    <i class="fas fa-file-import fa-sm"></i> Import Cars
                </button>
            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- Import Cars Modal -->
        <div class="modal fade" id="importCarsModal" tabindex="-1" aria-labelledby="importCarsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('cars.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importCarsModalLabel">Import Cars</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted">
                                Upload an Excel (.xlsx/.xls) or CSV file with columns for Make, Model, Year, Doors,
                                Transmission, Passengers, Daily Rate, Weekly Rate, and (optional) Uber/Lyft Weekly Rate.
                                Make, Model, Year, Daily Rate, and Weekly Rate are required for a row to be imported.
                            </p>
                            <input type="file" name="file" accept=".xlsx,.xls,.csv"
                                class="form-control @error('file') is-invalid @enderror" required>
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="8%">Image</th>
                                <th width="10%">Make</th>
                                <th width="10%">Model</th>
                                <th width="8%">Year</th>
                                <th width="15%">Registration Number</th>
                                <th width="10%">Status</th>
                                <th width="10%">Daily Rate</th>
                                <th width="10%">Weekly Rate</th>
                                <th width="10%">Uber/Lyft Weekly</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $item)
                                <tr>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ asset($item->image) }}" alt=""
                                                style="height:48px;width:72px;object-fit:cover;border-radius:4px;">
                                        @else
                                            <span class="text-muted small">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->make }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->registration_number }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="badge badge-secondary">Parked</span>
                                        @elseif($item->status == 1)
                                            <span class="badge badge-success">Available</span>
                                        @elseif($item->status == 2)
                                            <span class="badge badge-primary">Rented</span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge-warning">Maintenance</span>
                                        @else
                                            <span class="badge badge-dark">Unknown</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($item->rental_price_per_day, 2) }}</td>
                                    <td>{{ $item->weekly_rate !== null ? '$' . number_format($item->weekly_rate, 2) : '—' }}</td>
                                    <td>{{ $item->uber_lyft_weekly_rate !== null ? '$' . number_format($item->uber_lyft_weekly_rate, 2) : 'N/A' }}</td>
                                    <td style="display: flex">
                                        <a href="{{ route('cars.edit', $item->id) }}" class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        {{-- <div class="modal fade" id="deleteModal-{{ $contact->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalExample" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalExample">Are you Sure You
                                                            wanted to Delete?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Select "Delete" below if you want to delete
                                                        Contact!.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-danger" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('contact-delete-form-{{ $contact->id }}').submit();">
                                                            Delete
                                                        </a>
                                                        @if (isset($contact->id) && !empty($contact->id))
                                                            <form id="contact-delete-form-{{ $contact->id }}"
                                                                method="POST"
                                                                action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
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
