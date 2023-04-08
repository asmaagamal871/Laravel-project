@extends('layouts.app')

@section('content')
        <div class="container">
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
            <div style="margin: 40px;">
                @can('manage-own-orders')
                    <div class="text-center">
                        <a href="{{ route('orders.create') }}" class="mt-4 btn btn-success">Create order</a>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">Manage Orders</div>
                    <div class="card-body">
                        @if($dataTable->table())
                        {{ $dataTable->table() }}
                        @else
                        <label class="danger"> {{$error}} </label>
                       @endif
                    </div>
                </div>
            </div>
        @endsection

        @push('scripts')
            {{ $dataTable->scripts() }}
        @endpush

{{-- @section('content')
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
    <div style="margin: 40px;">
        @can('manage-own-orders')
            <div class="text-center">
                <a href="{{ route('orders.create') }}" class="mt-4 btn btn-success">Create order</a>
            </div>
        @endcan
        <br> --}}

    {{--  --}}

{{-- 
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user()->first()->type->name }}</td>
                        <td>{{ $order->address()->first()->st_name }}, {{ $order->address->building_no }},
                            {{ $order->address->floor_no }}, {{ $order->address->flat_no }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                        <td> --}}
                            {{-- <a href="{{route('orders.show', $order->id)}}" class="btn btn-info" style="color:white;">View</a>
                @canany(['manage-orders', 'manage-own-orders', 'update-order-status'])
                <a href="{{route('orders.edit', $order->id)}}" class="btn btn-primary">Edit</a>
                @endcanany
                <!-- Button trigger modal -->
                @canany(['manage-own-orders', 'delete-orders'])
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$order['id']}}">
                    Delete
                </button>
                @endcanany --}}
                        {{-- </td> --}}
                    {{-- </tr> --}}
                    {{-- <div class="modal fade" id="exampleModal{{$order['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this order?
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('orders.destroy', $order->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
                {{-- @endforeach --}}

            {{-- </tbody>

        </table>
    </div>--}}
{{-- @endsection  --}}
