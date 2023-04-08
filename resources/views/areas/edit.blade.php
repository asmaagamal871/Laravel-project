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

<form method="post" action="{{route('areas.update', $area->id)}}" style="margin-top: 40px;">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input name="name" type="text" value="{{$area->name}}" class="form-control" id="exampleFormControlInput1">
    </div>

{{-- <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Adress</label>
        <input name="address" type="text" value="{{$area->address}}" class="form-control" id="exampleFormControlInput1">
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Created at</label>
        <textarea name="created_at" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$area->created_at}}</textarea>
    </div>
 --}}


    <button class="btn btn-success">Update</button>
</form>

@endsection