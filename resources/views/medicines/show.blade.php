@extends('layouts.app')
@section('content')
<div class="card">a
  <div class="card-header">
 Medicine Info
  </div>
  <div class="card-body">
    <strong class="card-title">name: </strong><p>{{$medicine->name}}</p>
    <strong class="card-title">type: </strong><p>{{$medicine->type}}</p>
      <strong class="card-title">price: </strong><p>{{$medicine->price}}</p>
      
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>
@endsection