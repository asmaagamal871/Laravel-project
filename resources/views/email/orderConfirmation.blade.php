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
    <h1>hello {{ $notifiable->name }} </h1>

    @if ($order->orderMedicines()->get()->first())
        <div class="card mt-6">
            <h4 class="card-header">
                Medicines
            </h4>
            <div class="card-body">
                @foreach ($order->orderMedicines()->get() as $medicine)
                    <div class="card mt-6">
                        <h4 class="card-title" style="font-weight: bold;padding:10px">
                            {{ $medicine->medicine()->first()->name }}
                        </h4>
                        <div class="card-body">
                            <p class="card-text">Type: {{ $medicine->medicine()->first()->type }}</p>
                            <p class="card-text">Price: $ {{ $medicine->medicine()->first()->price }}</p>
                            <p class="card-text">Quantity: {{ $medicine->qty }}</p>
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
                    $ {{ $order->total_price }}
                </h4>
            </div>
        </div><br>
        @role('end-user')
            <div>
                <a href="" class="mt-4 btn btn-success">Confirm</a>
                <a href="" class=" mt-4 btn btn-danger">Cancel</a>
            </div><br>
        @endrole
    @endif



    <div class="btn-container">
        <form action="">
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>
        <a href="" type="submit" class="btn btn-danger" disabled>Cancel Order</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
