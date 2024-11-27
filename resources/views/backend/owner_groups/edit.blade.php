{{-- @extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Edit Owner Group</h2> --}}

    <form action="{{ route('admin.owner-groups.update', $ownerGroup) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $ownerGroup->name }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $ownerGroup->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
{{-- </div>
@endsection --}}
