@extends('layouts.app')
@section('content')
<!-- Create medicine Form -->
<form method="post" action="{{route('medicines.update',$medicine->id)}}"  enctype="multipart/form-data">

  @csrf
  @method('PUT')
  <div class="mb-3">
           <label for="name" class="form-label">name</label>
           <input name="name" type="text" class="form-control" id="name" value="{{$medicine->name}}" >
    
       </div>
 
       <div class="mb-3">
           <label for="type" class="form-label">type</label>
           <input name="type" type="text" class="form-control" id="type"value="{{$medicine->type}}" >
    
       </div>
       <div class="mb-3">
           <label for="price" class="form-label">price</label>
           <input name="price" type="text" class="form-control" id="price" value="{{$medicine->price}}">
    
       </div>
   
  <button type="submit" class="btn btn-primary">Update</button>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>
@endsection