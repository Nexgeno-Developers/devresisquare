{{-- @extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Edit Owner Group</h2> --}}

    <form action="{{ route('admin.owner-groups.update', $ownerGroup->id) }}" method="POST">
        @csrf
        @method('PUT')  {{-- Specify the HTTP method for updating --}}

        <input type="hidden" name="property_id" class="form-control" value="{{ $ownerGroup->property_id }}">

        <div class="form-group">
            <label for="contact_id">Contact</label>
            <select name="contact_id" id="contact_id" class="form-control" required>
                @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}" {{ $contact->id == $ownerGroup->contact_id ? 'selected' : '' }}>
                        {{ $contact->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="purchased_date">Purchased Date</label>
            <input type="date" name="purchased_date" id="purchased_date" class="form-control" value="{{ $ownerGroup->purchased_date }}" required>
        </div>

        <div class="form-group">
            <label for="sold_date">Sold Date</label>
            <input type="date" name="sold_date" id="sold_date" class="form-control" value="{{ $ownerGroup->sold_date }}">
        </div>

        <div class="form-group">
            <label for="archived_date">Archived Date</label>
            <input type="date" name="archived_date" id="archived_date" class="form-control" value="{{ $ownerGroup->archived_date }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active" {{ $ownerGroup->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $ownerGroup->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="archived" {{ $ownerGroup->status == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>

        <button type="submit" class="float-end mt-3 btn btn-success">Update</button>
    </form>
{{-- </div>
@endsection --}}
