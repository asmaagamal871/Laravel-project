@extends('layouts.app')
@section('title') Index @endsection

@section('content')
    
<div class="text-center">
    <a href="{{route('areas.create')}}" class="mt-4 btn btn-success">Create area</a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
          
        </tr>
        
    </thead>
    <tbody>

        @foreach($areas as $area)
            
        <tr>
            <td>{{$area->id}}</td>
            <td>{{$area->name}}</td>
            
            
            <td>
                <a href="{{route('areas.show', $area->id)}}" class="btn btn-info" style="color:white;">View</a>
                <a href="{{route('areas.edit', $area->id)}}" class="btn btn-primary">Edit</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{$area['id']}}">
                    Delete
                </button>
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
                        Are you sure you want to delete this area?
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('areas.destroy', $area->id)}}" method="POST">
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
    {{-- {{ $doctors->links() }} --}}

      
@endsection