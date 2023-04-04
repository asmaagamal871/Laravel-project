@extends('layouts.app')
@section('content')
<div class="text-center">
        <button type="button" class="mt-4 btn btn-success"><a  class="text-decoration-none" href="{{route('addresses.create')}}">Create address</address></a></button>
    </div>
    <table class="table mt-4 container fs-5">
        <thead>
        <tr>
          <th>#</th>
            <th scope="col">st_name</th>
            <th scope="col">building_no</th>
            <th scope="col">floor_no</th>
            <th scope="col">flat_no</th>
            <th scope="col">is_main</th>
            <th scope="col">user_name</th>
            <th scope="col">area_name</th>
        </tr>
        </thead>
        <tbody>

        @foreach($addresses as $address)
            <tr>
               <td>{{$address->id}}</td>
               <td>{{$address->st_name}}</td>
                <td>{{$address->building_no}}</td>
                <td>{{ $address->floor_no}}</a></td>
                <td>{{ $address->flat_no}}</a></td>
                <td>{{$address->is_main}}</td>
                <td>{{ $address->end_user->type->name}}</a></td>
                <td>{{ $address->area->name}}</a></td>
           
            </tr>
       
        <td>
                <a href="{{route('addresses.edit',$address['id'])}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('addresses.show', $address['id'])}}" class="btn btn-info">View</a>
                    <form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post" action="{{route('addresses.destory',$address['id'])}}"> 
                    @method('DELETE')
                    @csrf
                  
                    <button type="submit" class="btn btn-danger"> delete</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection

