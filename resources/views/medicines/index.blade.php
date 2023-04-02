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

<div class="text-center">
        <button type="button" class="mt-4 btn btn-success"><a  class="text-decoration-none" href="{{route('medicines.create')}}">Create medicine</a></button>
    </div>
    <table class="table mt-3">
        <thead>
        <tr>
          <th>#</th>
            <th scope="col">name</th>
            <th scope="col">type</th>
            <th scope="col">price</th>
        </tr>
        </thead>
        <tbody>

        @foreach($medicines as $medicine)
            <tr>
               <td>{{$medicine->id}}</td>
                <td>{{$medicine->name}}</td>
                <td>{{ $medicine->type}}</a></td>
                <td>{{ $medicine->price}}</a></td>
              
           
            </tr>
       
        <td>
                <a href="{{route('medicines.edit',$medicine['id'])}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('medicines.show', $medicine['id'])}}" class="btn btn-info">View</a>
                    <form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post" action="{{route('medicines.destory',$medicine['id'])}}"> 
                    @method('DELETE')
                    @csrf
                  
                    <button type="submit" class="btn btn-danger"> delete</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>

