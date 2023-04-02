<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Scripts -->
  
</head>
<body>
<!-- Create address Form -->
<form method="post" action="{{route('addresses.update',$address->id)}}"  enctype="multipart/form-data">

  @csrf
  @method('PUT')
  <div class="mb-3">
           <label for="st_name" class="form-label">st_name</label>
           <input name="st_name" type="text" class="form-control" id="name" value="{{$address->st_name}}">
    
       </div>
 
       <div class="mb-3">
           <label for="building_no" class="form-label">building_no</label>
           <input name="building_no" type="number" class="form-control" id="building_no" value="{{$address->building_no}}">
    
       </div>
       <div class="mb-3">
           <label for="floor_no" class="form-label">floor_no</label>
           <input name="floor_no" type="number" class="form-control" id="floor_no"value="{{$address->floor_no}}" >
    
       </div> 
       <div class="mb-3">
           <label for="flat_no" class="form-label">flat_no</label>
           <input name="flat_no" type="number" class="form-control" id="flat_no"value="{{$address->flat_no}}">
    
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
                @foreach($users as $user)
                    <option value="{{$user->national_id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

  <button type="submit" class="btn btn-primary">Update</button>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>