<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h1>hello <strong>{{ $notifiable->name }}</strong> </h1>
    <div>
        <p>
        <h3>Address details: </h3>
        </p>
        <p>Area: {{ $order->address->area->name }}</p>
        <p>Address:
            {{ $order->address->st_name }}, {{ $order->address->building_no }},
            {{ $order->address->floor_no }},{{ $order->address->flat_no }}
        </p>
    </div>
    <div>


        @foreach ($order->orderMedicines()->get() as $item)
            <p> <strong>Medicine Name: </strong>{{ $item->medicine->name }} </p>
            <p> <strong>Quantity: </strong>{{ $item->qty }} </p>
        @endforeach
        <p><strong>Total Price: {{$order->total_price}}</strong></p>
    </div>


    <div class="btn-container">
        <form action="">
            <a href="{{route('stripe.get',$order->id)}}" type="submit" class="btn btn-success">Confirm Order</a>
        </form>
        <a href="{{route('orders.cancel',$order->id)}}" type="submit" class="btn btn-danger" disabled>Cancel Order</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
