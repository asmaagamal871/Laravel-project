@extends('layouts.app')


@section('title')
    Create area
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

    <form method="POST" action="{{route('areas.store')}}" style="margin-top: 40px;">
        @csrf
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">name</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">address</label>
            <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>


        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">id</label>
            <textarea name="id" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="row mb-3">
            <label for="formFile" class="col-md-4 col-form-label text-md-end">Choose avatar</label>
            <div class="col-md-6">
                <input class="form-control" type="file" id="formFile" accept=".jpg,.jpeg" name="avatar" />
            </div></div>
       


       
        <button class="btn btn-success">Submit</button>
    </form>
