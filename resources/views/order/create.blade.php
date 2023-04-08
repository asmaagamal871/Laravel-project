@extends('layouts.app')

@section('title')
Orders
@endsection
@section('breadcrumb')
Create order
@endsection
@section('content')

@role('pharmacy')
<form method="POST" action="{{route('orders.store')}}" style="margin: 40px;" enctype="multipart/form-data">
    @csrf

    @if (session('error'))
    <div role="alert" class="fw-bold fs-5 mb-3 text-center text-danger">{{ session('error') }}</div>
    @endif
    <div class="form-group">
        <label>Select user</label>
        <select class="form-control" name='order'>
            @foreach($new_orders as $order)
            <option value="{{$order->id}}">{{$order->user()->first()->type->name}}, order number {{$order->id}}</option>
            @endforeach
        </select><br>
    </div>
    <div class="form-group">
        <label>Select medicines</label>
        <select class="select2 form-control" name='meds[]' multiple="multiple" data-placeholder="Select medicines" style="width: 100%;">
            @foreach($medicines as $medicine)
            <option value="{{$medicine->id}}">{{$medicine->name}}</option>
            @endforeach
        </select><br>
        <!-- @foreach($medicines as $medicine)
        <div id="input-{{ $medicine->name }}" style="display: none;">
            <input type="text" name="{{ $medicine->id }}" placeholder="Enter quantity for {{ $medicine->name }}">
        </div>
        @endforeach -->
        <div class="form-group">
            <label>Quantity</label>
            <div class="input-group" id="input-container">
                <!-- input fields will be dynamically added/removed here -->
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Create order</button>
</form>

@endrole

@hasanyrole('admin|end-user')
@if ($errors->any())
<br>
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{route('orders.store')}}" style="margin: 40px;" enctype="multipart/form-data">
    @csrf

    @if (session('error'))
    <div role="alert" class="fw-bold fs-5 mb-3 text-center text-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Prescriptions</label>
        <input name="Prescriptions[]" type="file" accept=".jpg,.jpeg" multiple="multiple" class="form-control" id="exampleFormControlInput1" />
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
        <label class="form-label">Delivery address</label>
        <select name="address" class="form-control">
            @foreach($addresses as $address)
            <option value="{{$address->id}}">{{$address->area()->first()->st_name}}, {{$address->st_name}}, {{$address->building_no}}, {{$address->floor_no}}, {{$address->flat_no}}</option>
            @endforeach
        </select>
    </div>

    @can('manage-orders')
    <div class="mb-3">
        <label class="form-label">User</label>
        <select name="user" class="form-control">
            @foreach($all_users as $user)
            <option value="{{$user->id}}">{{$user->type->name}}</option>
            @endforeach
        </select>
    </div>
    @endcan

    <button type="submit" class="btn btn-success">Submit order</button>
</form>
@endhasanyrole
@endsection