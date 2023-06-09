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
            <p>{{$pharmacy->type->name}}</p>
            <strong class="card-title">Email: </strong>
            <p>{{$pharmacy->type->email}}</p>
            <strong class="card-title">Area ID: </strong>
            <p>{{$pharmacy->area_id}}</p>
            <strong class="card-title">National ID: </strong>
            <p>{{$pharmacy->national_id}}</p>
            <strong class="card-title">created_at: </strong>
            <p>{{$pharmacy->created_at}}</p>


        </div>

    </div>

    <a href="{{ route('pharmacies.edit', $pharmacy->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('pharmacies.destroy', $pharmacy->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('pharmacies.index') }}" class="btn btn-secondary float-right">Back</a>

    <hr>
    <h5>Doctors</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>National ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->id }}</td>
                <td>{{ $doctor->national_id }}</td>
                <td>
                    @if($doctor->isBanned())
                    
                    Banned

                    @else($doctor->isBanned())
                    
                    Not Banned
                    
                    @endif
                </td>
                <td>
                    @if ($doctor->isBanned())
                    <form action="{{ route('pharmacies.doctors.unban', [$pharmacy, $doctor]) }}" method="POST" style="display: inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Unban</button>
                    </form>
                    @else
                    <form action="{{ route('pharmacies.doctors.ban', [$pharmacy, $doctor]) }}" method="POST" style="display: inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Ban</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No doctors found.</td>
            </tr>
            @endforelse

        </tbody>
    </table>

</div>


@endsection