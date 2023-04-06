@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header">
 address Info
  </div>
  <div class="card-body">
    <strong class="card-title">st_name: </strong><p>{{$address->st_name}}</p>
    <strong class="card-title">building_no </strong><p>{{$address->building_no}}</p>
      <strong class="card-title">floor_no: </strong><p>{{$address->floor_no}}</p>
      <strong class="card-title">flat_no: </strong><p>{{$address->flat_no}}</p>
    <strong class="card-title">is_main </strong><p>{{$address->is_main}}</p>
      <strong class="card-title">area_name  :   </strong><p>{{$address->area->name}}</p>
      <strong class="card-title">user_name:</strong><p>{{ $address->end_user->type->name}}</p>
  </div>
</div>
@endsection