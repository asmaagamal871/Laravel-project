{{-- @extends('layouts.app')
@section('breadcrumb')
All Pharmacies
@endsection
@section('title')
Pharmacies
@endsection
@section('content')
<div class="container">
    <div class="text-center">
        <a href="{{ route('pharmacies.create') }}" class="mb-4 btn btn-success">Create pharmacy</a>
    </div>
    <div class="card">
        <div class="card-header">Manage Pharmacies</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
    <br>
</div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}
