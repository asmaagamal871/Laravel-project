@extends('layouts.app')
@section('title')
    Clients
@endsection
@section('breadcrumb')
    All Users
@endsection
@section('content')
@if (session('error'))
<div id ="alert-message" class="alert alert-danger my-4 alert-dismissible">
    {{ session('error') }}
    <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
</div>
@endif
@if (session('success'))
<div id ="alert-message" class="alert alert-success my-4 alert-dismissible">
    {{ session('success') }}
    <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
</div>
@endif
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
        <br>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
