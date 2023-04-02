@extends('layouts.app')

@section('title')
Update
@endsection

@section('content')


<form method="post" action="{{route('pharmacy.update', $pharmacy->id)}}" style="margin-top: 40px;">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input name="name" type="text" value="{{$pharmacy->name}}" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input name="email" type="text" value="{{$pharmacy->email}}" class="form-control" id="exampleFormControlInput1">
    </div>
    
    <button class="btn btn-success">Update</button>
</form>

@endsection