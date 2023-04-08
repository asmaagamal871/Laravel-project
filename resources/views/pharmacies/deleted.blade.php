@extends('layouts.app')

@section('content')

<div class="text-center">
    <a href="{{route('pharmacies.index')}}" class="mt-4 btn btn-primary">Back to Pharmacies</a>
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
            <th scope="col">Deleted At</th>
            <th scope="col">Actions</th>
        </tr>

    </thead>
    <tbody>

        @foreach($pharmacies as $pharmacy)

        <tr>
        <td><img src="{{($pharmacy->image) }}" width="100" height="100"></td>
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
            <td>{{$pharmacy->deleted_at}}</td>

            <td>

                @if($pharmacy->deleted_at)
                <form action="{{ route('pharmacies.restore', $pharmacy->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Restore</button>
                </form>
                @endif
            </td>
        </tr>
        

        @endforeach
    </tbody>

</table>

@endsection
