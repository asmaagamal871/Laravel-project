@extends('layouts.app')
@section('content')
<form method="post" action="{{route('addresses.store')}}"   enctype="multipart/form-data">
  @csrf
       <div class="mb-3">
           <label for="st_name" class="form-label">st_name</label>
           <input name="st_name" type="text" class="form-control" id="st_name" >
    
       </div>
 
       <div class="mb-3">
           <label for="building_no" class="form-label">building_no</label>
           <input name="building_no" type="number" class="form-control" id="building_no" >
    
       </div>
       <div class="mb-3">
           <label for="floor_no" class="form-label">floor_no</label>
           <input name="floor_no" type="number" class="form-control" id="floor_no" >
    
       </div> 
       <div class="mb-3">
           <label for="flat_no" class="form-label">building_no</label>
           <input name="flat_no" type="number" class="form-control" id="flat_no" >
    
       </div>
   

<div class="mb-3">
     <label class="form-label">Is your adress main</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="radio" id="yes_radio" value="1">
        <label class="form-check-label" for="yes_radio">Yes</label>
    </div>

<div class="form-check">
   <input class="form-check-input" type="radio" name="radio" id="no_radio" value="0" checked>
   <label class="form-check-label" for="no_radio">No</label>
</div>
</div>
<div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">name of area</label>
            <select name="area_id" class="form-control">
                @foreach($areas as $area)
                    <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">name of user</label>
            <select name="user_id" class="form-control">
                @foreach($EndUsers as $EndUser)
                    <option value="{{$EndUser->type->typeable_id}}">{{$EndUser->type->name}}</option>
                @endforeach
            </select>
        </div>

      <button type="submit" class="btn btn-primary">create</button>
</form>
@endsection