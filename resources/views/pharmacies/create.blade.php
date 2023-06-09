@extends('layouts.app')


@section('content')


    <form method="POST" action="{{route('pharmacies.store')}}" style="margin-top: 40px;" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">email</label>
            <textarea name="email" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">password</label>
            <textarea name="password" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">priority</label>
            <textarea name="priority" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Area ID</label>
            <select name="area_id" class="form-control" id="exampleFormControlSelect1">
                @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">National ID</label>
            <textarea name="national_id" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="col-md-6">
        <input class="form-control" type="file" id="formFile" accept=".jpg,.jpeg" name="image" />
    </div>


        <button class="btn btn-success">Create new Pharmacy</button>
    </form>
@endsection

    
