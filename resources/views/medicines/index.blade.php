@extends('layouts.app')
@section('content')

<div class="text-center">
        <button type="button" class="mt-4 btn btn-success"><a  class="text-decoration-none" href="{{route('medicines.create')}}">Create medicine</a></button>
    </div>
    <table class="table ">
        <thead>
        <tr>
          <th>#</th>
            <th scope="col">name</th>
            <th scope="col">type</th>
            <th scope="col">price</th>
        </tr>
        </thead>
        <tbody>

        @foreach($medicines as $medicine)
            <tr>
               <td>{{$medicine->id}}</td>
                <td>{{$medicine->name}}</td>
                <td>{{ $medicine->type}}</a></td>
                <td>{{ $medicine->price}}</a></td>
              
           
            </tr>
       
        <td>
                <a href="{{route('medicines.edit',$medicine['id'])}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('medicines.show', $medicine['id'])}}" class="btn btn-info">View</a>
                    <form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post" action="{{route('medicines.destory',$medicine['id'])}}"> 
                    @method('DELETE')
                    @csrf
                  
                    <button type="submit" class="btn btn-danger"> delete</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

