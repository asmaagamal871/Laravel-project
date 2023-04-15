<div class="btn-group">
    <a href="{{ route('users.edit', $endUser->id) }}" class="btn btn-primary">Edit</a>
    <a href=" {{ route('users.show', $endUser->id) }}" class="btn btn-success">View</a>
        <button type="" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal{{$endUser->id}}" >Delete</button>
</div>


<div class="modal fade" id="exampleModal{{$endUser->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <p>Are you sure you want to delete this client? </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
        <form action="{{ route('users.destroy', $endUser->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" name="" class="btn btn-danger" >delete</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>