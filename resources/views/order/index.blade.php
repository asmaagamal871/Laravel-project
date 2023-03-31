@foreach($orders as $order)
<li>{{ $order->id }}</li>
@endforeach
<div class="text-center">
    <a href="{{route('orders.create')}}" class="mt-4 btn btn-success">Create order</a>
</div>