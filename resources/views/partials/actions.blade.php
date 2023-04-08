<div class="btn-group">
    <a href="{{ route('users.edit', $endUser->id) }}" class="btn btn-primary">Edit</a>
    <a href=" {{ route('users.show', $endUser->id) }}" class="btn btn-success">View</a>
    <form method="POST" action="{{ route('users.destroy', $endUser->id) }}" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
    </form>
</div>
{{-- {{ route('items.edit', $item->id) }} --}}

{{-- {{ route('items.show', $item->id) }} --}}

{{-- {{ route('items.destroy', $item->id) }} --}}
