@extends('layouts.app')

@section('content')
    <div class="container">

            <div class="card">
                <div class="card-header">
                Pharmacy Info
            </div>
        
            <div class="card-body">
                <strong class="card-title">ID: </strong>
                <p>{{$pharmacy->id}}</p>
                <strong class="card-title">Name: </strong>
                <p>{{$pharmacy->name}}</p>
                <strong class="card-title">Email: </strong>
                <p>{{$pharmacy->email}}</p>
                <strong class="card-title">area_id: </strong>
                <p>{{$pharmacy->area_id}}</p>
                <strong class="card-title">created_at: </strong>
                <p>{{$pharmacy->created_at}}</p>
            </div>
        </div>

        <a href="{{ route('pharmacy.edit', $pharmacy->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('pharmacy.destroy', $pharmacy->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('pharmacy.index') }}" class="btn btn-secondary float-right">Back</a>
    </div>
@endsection