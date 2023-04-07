@extends('layouts.app')

@section('content')
<h1>show</h1>


<div class="card">
  <div class="card-header">
   doctor Info
  </div>
  <div class="card-body">
    <strong class="card-title">Name: </strong>
    <p>{{$doctors->type->name}}</p>
    <strong class="card-title">created at: </strong>
    <p>{{$doctors->created_at}}</p>
  </div>
</div>

@endsection