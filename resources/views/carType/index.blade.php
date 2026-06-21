@extends('layouts.app')

@section('title', 'Car Types')

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
                                <th>Car Types</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>

                                    <td style="display: flex">
                                        <a href="#" class="btn btn-primary m-2" data-toggle="modal"
                                            data-target="#editModal-{{ $item->id }}">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalExample" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalExample">EDIT DATA</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" encrypt="multipart-encrypt"
                                                            action="{{ route('carType.update') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ $item->id }}"
                                                                name="id">
                                                            <div class="form-group row">
                                                                {{-- Make --}}
                                                                <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                                                                    <div class="card-body">
                                                                        <span style="color:red;">*</span>Car Type</label>
                                                                        <input type="text"
                                                                            class="form-control form-control-contact @error('make') is-invalid @enderror"
                                                                            id="exampleMake" placeholder="Sports,Luxury etc"
                                                                            name="carType" value="{{ $item->name }}"
                                                                            required>

                                                                        @error('carType')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="card-footer mt-2">
                                                                        <button type="submit"
                                                                            class="btn btn-success float-right btn-contact mb-3">Update</button>

                                                                        <a class="btn btn-primary mr-3 mb-3 float-right"
                                                                            href="{{ route('carType.index') }}">Cancel</a>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Cancel</button>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
