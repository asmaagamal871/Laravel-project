<a href="{{ route('medicines.edit', $medicine['id']) }}" class="btn btn-primary">Edit</a>
<a href="{{ route('medicines.show', $medicine['id']) }}" class="btn btn-info">View</a>
<form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post"
    action="{{ route('medicines.destory', $medicine['id']) }}">
    @method('DELETE')
    @csrf

    <button type="submit" class="btn btn-danger"> delete</button>
</form>
