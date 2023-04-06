@extends('layouts.app')

@section('content')
<div style="margin: 40px;">
    <div class="card mt-6">
        <h4 class="card-header">
            Order Information </h4>
        <div class="card-body">
            <h4 class="card-title" style="font-weight: bold;">User Name: {{$order->user()->first()->type->name}}</h4>
            <p class="card-text">Delivery address: {{$order->address()->first()->st_name}}, {{$order->address->building_no}}, {{$order->address->floor_no}}, {{$order->address->flat_no}}</p>
            @if($order->address()->first()->is_main)
            <p class="card-text">Main address: Yes</p>
            @else
            <p class="card-text">Main address: No</p>
            @endif
            <p class="card-text">Status: {{$order->status}}</p>
            @if($order->status == 'processing')
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
    @if($order->orderMedicines()->get())
    @endif
</div>
@endsection