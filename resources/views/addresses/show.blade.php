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
      <strong class="card-title">area_id </strong><p>{{$address->area_id}}</p>
      <strong class="card-title">user_id </strong><p>{{$address->user_id}}</p>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>