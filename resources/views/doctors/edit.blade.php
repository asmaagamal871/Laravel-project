@extends('layouts.app')

@section('title')
Update
@endsection

@section('content')
<!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

<form method="post" action="{{route('doctors.update', $doctor->id)}}" style="margin-top: 40px;">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input name="name" type="text" value="{{$doctor->type->name}}" class="form-control" id="exampleFormControlInput1">
    </div>

 <div class="mb-3"> 
        <label for="exampleFormControlInput1" class="form-label">email</label>
        <input name="email" type="text" value="{{$doctor->type->email}}" class="form-control" id="exampleFormControlInput1">
    </div>

 
    <div class="mb-3"> 
        <label for="exampleFormControlInput1" class="form-label">password</label>
        <input name="password" type="password" value="{{$doctor->type->password}}" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="mb-3"> 
        <label for="exampleFormControlInput1" class="form-label">national_id</label>
        <input name="national_id" type="text" value="{{$doctor->national_id}}" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="col-md-6">
        <input class="form-control" type="file" id="formFile" accept=".jpg,.jpeg" name="avatar" />
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection