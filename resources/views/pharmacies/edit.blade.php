@extends('layouts.app')

@section('content')


<form method="post" action="{{route('pharmacies.update', $pharmacy->id)}}" style="margin-top: 40px;">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input name="name" type="text" value="{{$pharmacy->type->name}}" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input name="email" type="text" value="{{$pharmacy->type->email}}" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Area ID</label>
        <input name="area_id" type="text" value="{{$pharmacy->area_id}}" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">National ID</label>
        <input name="national_id" type="text" value="{{$pharmacy->national_id}}" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Priority</label>
        <input name="priority" type="text" value="{{$pharmacy->priority}}" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="col-md-6">
        <input class="form-control" type="file" id="formFile" accept=".jpg,.jpeg" name="avatar" />
    </div>
    
    <button class="btn btn-success">Update</button>
</form>

@endsection