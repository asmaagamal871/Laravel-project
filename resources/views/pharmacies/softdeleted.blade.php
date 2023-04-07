@extends('layouts.app')

@section('content')
    
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Area ID</th>
            <th scope="col">Priority</th>
            <th scope="col">Deleted at</th>
            <th scope="col">Actions</th>
        </tr>
        
    </thead>
    <tbody>

        @foreach($pharmacy as $pharmacy)
            
        <tr>
            <td>{{$pharmacy->id}}</td>
            <td>{{$pharmacy->name}}</td>
            <td>{{$pharmacy->email}}</td>
            <td>{{$pharmacy->area_id}}</td>
            <td>{{$pharmacy->priority}}</td>
            <td>{{$pharmacy->deleted_at}}</td>
            
            <td>
            @if($pharmacy->deleted_at)
                <form action="{{ route('pharmacy.restore', $pharmacy->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Restore</button>
                </form>
            @else
                <a href="{{route('pharmacy.show', $pharmacy->id)}}" class="btn btn-info" style="color:white;">View</a>
                <a href="{{route('pharmacy.edit', $pharmacy->id)}}" class="btn btn-primary">Edit</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{$pharmacy['id']}}">
                    Delete
                </button>
                @endif
            </td>
        </tr>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form action="{{route('pharmacy.destroy', $pharmacy->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </tbody>

</table>
    {{-- {{ $pharmacy->links() }} --}}

      
@endsection