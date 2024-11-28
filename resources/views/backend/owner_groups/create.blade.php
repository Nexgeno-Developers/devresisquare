{{-- @extends('backend.layout.app')

@section('content')
<div class="container">
    <h2>Create Owner Group</h2> --}}

    <form action="{{ route('admin.owner-groups.store') }}" method="POST">
        @csrf
        <input type="hidden" name="property_id" class="form-control" value="">
        <div class="form-group">
            <label for="contact_id">Contact</label>
            <select name="contact_id" id="contact_id" class="form-control" required>
                @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group">
            <label for="property_id">Property</label>
            <select name="property_id" id="property_id" class="form-control" required>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->address }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label for="purchased_date">Purchased Date</label>
            <input type="date" name="purchased_date" id="purchased_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="sold_date">Sold Date</label>
            <input type="date" name="sold_date" id="sold_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="archived_date">Archived Date</label>
            <input type="date" name="archived_date" id="archived_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <button type="submit" class="float-end mt-3 btn btn-success">Save</button>
    </form>
{{-- </div>
@endsection --}}
