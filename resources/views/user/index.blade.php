@extends('layouts.app')
@section('title')
Clients
@endsection
@section('breadcrumb')
All Users
@endsection
@section('content')
    <div class="container">
        <div class="text-center">
            <a href="{{ route('users.create') }}" class="mb-4 btn btn-success">Create user</a>
        </div>
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
