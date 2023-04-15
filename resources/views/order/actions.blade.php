<div class="btn-group">
    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info" style="color:white;">View</a>
    @canany(['manage-orders', 'manage-own-orders', 'update-order-status'])
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit</a>
    @endcanany
    <!-- Button trigger modal -->
    @canany(['manage-own-orders', 'delete-orders'])
        {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$order['id']}}">
                    Delete
                </button> --}}


        <button type="submit" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#exampleModal{{$order->id}}">Delete</button>
        </form>
    @endcanany



</div>

<div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this order? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="" class="btn btn-danger">delete</button>
                </form>

            </div>
        </div>
    </div>
</div>
