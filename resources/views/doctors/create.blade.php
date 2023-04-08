@extends('layouts.app')


@section('title')
    Create Doctor
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

    <form method="POST" action="{{route('doctors.store')}}" style="margin-top: 40px;">
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
            <label for="exampleFormControlTextarea1" class="form-label">national_id</label>
            <textarea name="national_id" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="col-md-6">
            <input class="form-control" type="file" id="formFile" accept=".jpg,.jpeg" name="avatar" />
        </div>
    

        @can('manage-doctors')
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">pharmacies</label>
            <select name="pharmacy" class="form-control">
                @foreach($pharmacies as $pharmacy)
                <option value="{{$pharmacy->id}}"> {{$pharmacy->type->name}}</option>
                @endforeach
            </select>
        </div>
        @endcan
    
    


       
        <button class="btn btn-success">Submit</button>
    </form>
