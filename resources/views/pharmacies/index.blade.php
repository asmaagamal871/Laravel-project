@extends('layouts.app')
@section('title')
    Pharmacies
@endsection
@section('breadcrumb')
    All Pharmacies
@endsection
@section('content')


<div class="container">
    <div class="text-center">
        <a href="{{route('pharmacies.create')}}" class="mb-4 btn btn-success">Add new Pharmacy</a>
        <a href="{{route('pharmacies.deleted')}}" class="mb-4 btn btn-danger">Deleted Pharmacies</a>
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
@endpush


{{-- @extends('layouts.app')
@section('breadcrumb')
All Pharmacies
@endsection
@section('title')
Pharmacies
@endsection
@section('content')

<div class="text-center">
    <a href="{{route('pharmacies.create')}}" class="mt-4 btn btn-success">Add new Pharmacy</a>
    <a href="{{route('pharmacies.deleted')}}" class="mt-4 btn btn-danger">Deleted Pharmacies</a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">image</th>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Area ID</th>
            <th scope="col">National ID</th>
            <th scope="col">Priority</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>

    </thead>
    <tbody>

        @foreach($pharmacies as $pharmacy)

        <tr>
        <td><img src="{{Storage::url($pharmacy->image)}}" width="150px"></td>
            <td>{{$pharmacy->id}}</td>
            @if($pharmacy->type)
            <td>{{$pharmacy->type->name}}</td>
            @else
            <td>not found</td>
            @endif
            @if($pharmacy->type)
            <td>{{$pharmacy->type->email}}</td>
            @else
            <td>not found</td>
            @endif
            <td>{{$pharmacy->area_id}}</td>
            <td>{{$pharmacy->national_id}}</td>
            <td>{{$pharmacy->priority}}</td>
            <td>{{$pharmacy->created_at}}</td>

            <td>

                @if($pharmacy->deleted_at)
                <form action="{{ route('pharmacies.restore', $pharmacy->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Restore</button>
                </form>
                @else
                <a href="{{route('pharmacies.show', $pharmacy->id)}}" class="btn btn-info" style="color:white;">View</a>
               <!-- @endif
                @if(!$pharmacy->deleted_at) -->
                <!-- @if(auth()->user()->can('manage-pharmacies') || auth()->user()->id === $pharmacy->id) -->
                <a href="{{ route('pharmacies.edit', $pharmacy->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                
                
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $pharmacy->id }}">
                    Delete
                </button>
                @endif
            @endif
            </td>
        </tr>

        <div class="modal fade" id="exampleModal{{$pharmacy->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Pharmacy?
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('pharmacies.destroy', $pharmacy->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush --}}
