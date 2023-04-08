<a href="{{route('addresses.edit',$address['id'])}}" class="btn btn-primary">Edit</a>
<a href="{{route('addresses.show', $address['id'])}}" class="btn btn-info">View</a>
<form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post" action="{{route('addresses.destory',$address['id'])}}"> 
@method('DELETE')
@csrf

<button type="submit" class="btn btn-danger"> delete</button>
</form>