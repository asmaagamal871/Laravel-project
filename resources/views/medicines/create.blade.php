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
<form method="post" action="{{route('medicines.store')}}"   enctype="multipart/form-data">
  @csrf
       <div class="mb-3">
           <label for="name" class="form-label">name</label>
           <input name="name" type="text" class="form-control" id="name" >
    
       </div>
 
       <div class="mb-3">
           <label for="type" class="form-label">type</label>
           <input name="type" type="text" class="form-control" id="type" >
    
       </div>
       <div class="mb-3">
           <label for="price" class="form-label">price</label>
           <input name="price" type="text" class="form-control" id="price" >
    
       </div>
   
      <button type="submit" class="btn btn-primary">create</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>