{{-- @if ($pharmacy->deleted_at)
<form action="{{ route('pharmacies.restore', $pharmacy->id) }}" method="post">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">Restore</button>
</form>
@else
<a href="{{ route('pharmacies.show', $pharmacy->id) }}" class="btn btn-info"
    style="color:white;">View</a>
@endif
@if (!$pharmacy->deleted_at)
@if (auth()->user()->can('manage-pharmacies') || auth()->user()->id === $pharmacy->id)
    <a href="{{ route('pharmacies.edit', $pharmacy->id) }}"
        class="btn btn-secondary btn-sm">Edit</a>


    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
        data-bs-target="#exampleModal{{ $pharmacy->id }}">
        Delete
    </button>
@endif
@endif



<div class="modal fade" id="exampleModal{{ $pharmacy->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Pharmacy?
            </div>
            <div class="modal-footer">
                <form action="{{ route('pharmacies.destroy', $pharmacy->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}