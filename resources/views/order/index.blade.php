@extends('layouts.app')
@section('content')
@foreach($orders as $order)
<li>{{ $order->id }}
    @canany(['manage-own-orders','delete-orders'])
    <form action="{{route('orders.destroy', $order->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcanany
</li>
@endforeach
@can('manage-own-orders')
<div class="text-center">
    <a href="{{route('orders.create')}}" class="mt-4 btn btn-success">Create order</a>
</div>
@endcan
@endsection