@extends('layouts.app')
@section('title')
    Doctors
@endsection
@section('breadcrumb')
    All Doctors
@endsection
@section('content')
    <div class="container">
        <div class="text-center">
            <a href="{{ route('users.create') }}" class="mb-4 btn btn-success">Create Doctor</a>
        </div>
        <div class="card">
            <div class="card-header">Manage Doctors</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
        <br>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
