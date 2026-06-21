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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10%">Make</th>
                                <th width="10%">Model</th>
                                <th width="10%">Year</th>
                                <th width="20%">Registration Number</th>
                                <th width="10%">Type</th>
                                <th width="10%">Status</th>
                                <th width="20%">Rent(Per Day)</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $item)
                                <tr>
                                    <td>{{ $item->make }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->registration_number }}</td>
                                    <td>{{ $item->carType->name }}</td>
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
                                    <td>{{ $item->rental_price_per_day }}</td>
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
