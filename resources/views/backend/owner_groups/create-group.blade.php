<form action="{{ route('admin.owner-groups.store_group') }}" method="POST">
    @csrf
    <input type="hidden" name="property_id" class="form-control" value="">

    <div class="form-group">
        <button type="button" class="btn btn-outline-primary btn-sm" id="addContactBtn">
            Add New Contact
        </button>
        <label for="contact_id">Contacts</label>
        <select name="contact_id[]" id="contact_id" class="form-control select2" multiple required>
            @foreach($contacts as $contact)
                <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="purchased_date">Purchased Date</label>
                <input type="date" name="purchased_date" id="purchased_date" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="sold_date">Sold Date</label>
                <input type="date" name="sold_date" id="sold_date" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="archived_date">Archived Date</label>
                <input type="date" name="archived_date" id="archived_date" class="form-control">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="float-end mt-3 btn btn-secondary">Save</button>
</form>
