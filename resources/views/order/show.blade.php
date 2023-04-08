@extends('layouts.app')
@section('title')
Orders
@endsection
@section('breadcrumb')
View order
@endsection
@section('content')
<div style="margin: 40px;">
    <div class="card mt-6">
        <h4 class="card-header">
            Order Information </h4>
        <div class="card-body">
            <h4 class="card-title" style="font-weight: bold;">Name: {{$order->user()->first()->type->name}}</h4>
            <p class="card-text">Delivery address: {{$order->address()->first()->area()->first()->name}}, {{$order->address()->first()->st_name}}, {{$order->address->building_no}}, {{$order->address->floor_no}}, {{$order->address->flat_no}}</p>
            @if($order->address()->first()->is_main)
            <p class="card-text">Main address: Yes</p>
            @else
            <p class="card-text">Main address: No</p>
            @endif
            @if($order->status=='waitingCustConfirmation')
            <p class="card-text">Status: waiting for customer confirmation</p>
            @else
            <p class="card-text">Status: {{$order->status}}</p>
            @endif
            @if($order->status != 'new')
            <p class="card-text">Assigned pharmacy: {{$order->pharmacy()->first()->type->name}}</p>
            @endif
            @if($order->is_insured)
            <p class="card-text">Insurance: Yes</p>
            @else
            <p class="card-text">Insurance: No</p>
            @endif
            <p class="card-text">Created at: {{ date('l jS \o\f F Y h:i:s A', strtotime($order->created_at))}}</p>

        </div>
    </div><br>
    @if($order->prescriptions()->get()->first())
    <div class="card mt-6">
        <h4 class="card-header">
            Prescriptions
        </h4>
        <div class="card-body">
            @foreach($order->prescriptions()->get() as $prescription)
            <img src="{{Storage::url($prescription->prescription)}}" alt="{{Storage::path($prescription->prescription)}}" width="350px">
            @endforeach
        </div>
    </div><br>
    @endif
    @if($order->orderMedicines()->get()->first())
    <div class="card mt-6">
        <h4 class="card-header">
            Medicines
        </h4>
        <div class="card-body">
            @foreach($order->orderMedicines()->get() as $medicine)
            <div class="card mt-6">
                <h4 class="card-title" style="font-weight: bold;padding:10px">
                    {{$medicine->medicine()->first()->name}}
                </h4>
                <div class="card-body">
                    <p class="card-text">Type: {{$medicine->medicine()->first()->type}}</p>
                    <p class="card-text">Price: {{$medicine->medicine()->first()->price}}</p>
                    <p class="card-text">Quantity: {{$medicine->qty}}</p>
                </div>
            </div><br>
            @endforeach
        </div>
    </div><br>
    <div class="card mt-6">
        <h4 class="card-header">
            Total price
        </h4>
        <div class="card-body">
            <h4 class="card-title" style="font-weight: bold;padding:10px">
               $ {{$order->total_price}} 
            </h4>
        </div>
    </div><br>
    @endif
</div>
@endsection