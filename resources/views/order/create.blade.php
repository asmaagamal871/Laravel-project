<!-- @extends('layouts.app') -->

@section('title')
Create
@endsection

@section('content')
<!-- @if ($errors->any())
<br>
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif -->

<form method="POST" action="{{route('orders.store')}}" style="margin-top: 40px;" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Prescriptions</label>
        <input name="Prescriptions[]" type="file" accept=".jpg,.png" multiple="multiple" class="form-control" id="exampleFormControlInput1" />
    </div>
    <div class="mb-3">
        <label class="form-label">Is your order insured?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="yes_radio" value="1">
            <label class="form-check-label" for="yes_radio">
                Yes
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="no_radio" value="0" checked>
            <label class="form-check-label" for="no_radio">
                No
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Delivery address</label>
        <select name="address" class="form-control">
            @foreach($addresses as $address)
            <option value="{{$address->id}}">{{$address->st_name}}, {{$address->building_no}}, {{$address->floor_no}}, {{$address->flat_no}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Submit order</button>
</form>
@endsection