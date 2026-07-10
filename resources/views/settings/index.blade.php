@extends('layouts.app')

@section('title', 'Site Settings')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Site Settings</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page Tabs --}}
        <ul class="nav nav-pills mb-4">
            @foreach ($pages as $key => $page)
                <li class="nav-item mb-2">
                    <a class="nav-link {{ $key === $pageKey ? 'active' : '' }}"
                        href="{{ route('settings.index', ['page' => $key]) }}">
                        {{ $page['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <form method="POST" enctype="multipart/form-data" action="{{ route('settings.update', $pageKey) }}">
            @csrf

            @foreach ($pages[$pageKey]['sections'] as $section)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $section['label'] }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            @foreach ($section['fields'] as $key => $field)
                                @php
                                    $saved = $values[$key] ?? null;
                                    $current = $saved !== null && $saved !== '' ? $saved : $field['default'];
                                @endphp

                                @if ($field['type'] === 'image')
                                    <div class="col-sm-6 mb-3">
                                        <label class="mb-1">{{ $field['label'] }}</label>
                                        <div class="mb-2">
                                            <img src="{{ asset($current) }}" alt="{{ $field['label'] }}"
                                                style="max-height:70px;max-width:100%;border-radius:4px;background:#eee;">
                                        </div>
                                        <input type="file" accept="image/*" class="form-control-file"
                                            name="images[{{ $key }}]">
                                        <small class="text-muted">Leave empty to keep current. JPG, PNG or WEBP. Max 4MB.</small>
                                    </div>
                                @elseif ($field['type'] === 'textarea')
                                    <div class="col-sm-6 mb-3">
                                        <label class="mb-1">{{ $field['label'] }}</label>
                                        <textarea class="form-control form-control-contact" rows="3"
                                            name="settings[{{ $key }}]"
                                            placeholder="{{ $field['default'] }}">{{ $saved }}</textarea>
                                        <small class="text-muted">Leave blank to use the default text.</small>
                                    </div>
                                @else
                                    <div class="col-sm-6 mb-3">
                                        <label class="mb-1">{{ $field['label'] }}</label>
                                        <input type="text" class="form-control form-control-contact"
                                            name="settings[{{ $key }}]" value="{{ $saved }}"
                                            placeholder="{{ $field['default'] }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mb-5">
                <button type="submit" class="btn btn-success btn-contact">Save {{ $pages[$pageKey]['label'] }}</button>
            </div>
        </form>
    </div>
@endsection
