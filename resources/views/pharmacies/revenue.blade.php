@extends('layouts.app')
@section('title')
Revenue
@endsection
@section('breadcrumb')
View revenue
@endsection
@section('content')
@role('admin')
<div style="margin: 40px;">
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Name</th>
                <th scope="col">Total orders</th>
                <th scope="col">Total revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pharmacies as $pharmacy)
            <tr>
                <td><img src="{{Storage::url($pharmacy->image)}}" width="150px"></td>
                <td>{{$pharmacy->type->name}}</td>
                
                <td>{{$pharmacy->total_orders}}
                </td>
                <td>{{$pharmacy->total_revenue}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endrole
@role('pharmacy')
<div style="margin: 40px;">
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Name</th>
                <th scope="col">Total orders</th>
                <th scope="col">Total revenue</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="{{Storage::url($pharmacy->image)}}" width="150px"></td>
                <td>{{$pharmacy->type->name}}
                <td>
                <td>{{$pharmacy->total_orders}}
                <td>
                <td>{{$pharmacy->total_revenue}}
                <td>
            </tr>
        </tbody>
    </table>
</div>
@endrole
@endsection