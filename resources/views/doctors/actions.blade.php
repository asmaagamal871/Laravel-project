<a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-info" style="color:white;">View</a>
<a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary">Edit</a>
{{-- <-- Button trigger modal --> --}}

<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $doctor['id'] }}"
    value="{{ $doctor['id'] }}">
    Delete
</button>
<div class="modal fade" id="exampleModal{{ $doctor['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this doctor?
            </div>
            <div class="modal-footer">
                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
