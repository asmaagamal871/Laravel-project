<div class="btn-group">
    {{-- <a href="" class="btn btn-primary">Edit</a>
    <a href=" {{ route('users.show', $user->id) }}" class="btn btn-success">View</a>
    <form action="" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
    </form> --}}



    <a href="{{route('orders.show', $order->id)}}" class="btn btn-info" style="color:white;">View</a>
                @canany(['manage-orders','manage-own-orders', 'update-order-status'])
                <a href="{{route('orders.edit', $order->id)}}" class="btn btn-primary">Edit</a>
                @endcanany
                <!-- Button trigger modal -->
                @canany(['manage-own-orders','delete-orders'])
                {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$order['id']}}">
                    Delete
                </button> --}}

                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                </form>


                @endcanany



</div>
{{-- {{ route('items.edit', $item->id) }} --}}

{{-- {{ route('items.show', $item->id) }} --}}

{{-- {{ route('items.destroy', $item->id) }} --}}
