<div class="btn-group">
    <a href="" class="btn btn-primary">Edit</a>
    <a href=" {{ route('users.show', $user->id) }}" class="btn btn-success">View</a>
    <form action="" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
    </form>
</div>
{{-- {{ route('items.edit', $item->id) }} --}}

{{-- {{ route('items.show', $item->id) }} --}}

{{-- {{ route('items.destroy', $item->id) }} --}}