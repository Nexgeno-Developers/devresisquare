<div id="mainForm">
    <form id="owner-group-form" action="{{ route('admin.owner-groups.update_group', $ownerGroup->id) }}" method="POST">
        @csrf
        <input type="hidden" name="property_id" class="form-control" value="{{ old('property_id', $ownerGroup->property_id) }}">

        <button type="button" class="d-flex float-end btn btn-outline-primary btn-sm" id="addContactBtn">Add New Contact</button>

        <div class="form-group">
            <label for="contact_id">Contacts</label>
            <select name="contact_id[]" id="contact_id" class="form-control select2" multiple="multiple" required>
                @foreach($contacts as $contact)
                    <option value="{{ $contact->id }}"
                        @if(in_array($contact->id, $selectedContacts)) selected @endif>
                        {{ $contact->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="contact-options" class="mt-3">
            @foreach($ownerGroup->ownerGroupContacts as $ownerGroupContact)
                <div class="form-check">
                    <input type="radio" name="is_main" value="{{ $ownerGroupContact->contact->id }}" id="is_main_{{ $ownerGroupContact->contact->id }}" class="form-check-input"
                    @if($ownerGroupContact->is_main) checked @endif>
                    <label for="is_main_{{ $ownerGroupContact->contact->id }}" class="form-check-label">{{ $ownerGroupContact->contact->full_name }}</label>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="purchased_date">Purchased Date</label>
                    <input type="date" name="purchased_date" id="purchased_date" class="form-control" value="{{ old('purchased_date', $ownerGroup->purchased_date) }}" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="sold_date">Sold Date</label>
                    <input type="date" name="sold_date" id="sold_date" class="form-control" value="{{ old('sold_date', $ownerGroup->sold_date) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="archived_date">Archived Date</label>
                    <input type="date" name="archived_date" id="archived_date" class="form-control" value="{{ old('archived_date', $ownerGroup->archived_date) }}">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" @if($ownerGroup->status == 'active') selected @endif>Active</option>
                        {{-- <option value="inactive" @if($ownerGroup->status == 'inactive') selected @endif>Inactive</option> --}}
                        <option value="archived" @if($ownerGroup->status == 'archived') selected @endif>Archived</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="float-end mt-3 btn btn-secondary">Save</button>
    </form>
</div>

<div id="addContactFormContainer" style="display: none;">
    <form id="addContactForm">
        @csrf
        <input type="hidden" class="form-control" id="category_id" name="category_id" value="1">
        <div class="mb-3">
            <label for="contact_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="contact_name" name="full_name" required>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="contact_email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="contact_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="contact_phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Contact</button>
        <button type="button" class="btn btn-secondary" id="backToMainForm">Back</button>
    </form>
</div>

<script>
    initSelect2('.select2');


    // Form submission validation
    $('form').on('submit', function(e) {
        // confirmEdit();
        if ($('input[name="is_main"]:checked').length === 0) {
            e.preventDefault(); // Prevent form submission
            alert('Please select a main contact.'); // Show alert message
        }
    });

    function confirmEdit() {
        // Customize your confirmation message
        const currentStatus = "{{ $ownerGroup->status }}"; // Get current status from server
        const newStatus = document.querySelector('[name="status"]').value; // Get the selected status
        // let message = "Are you sure you want to save the changes?";

        // Special handling for status changes
        if (currentStatus === 'archived' && newStatus === 'active') {
            message = "You are activating an archived owner group. Proceed?";
            // Show confirmation dialog
            return confirm(message);
        }else if (currentStatus === 'active' && newStatus === 'archived') {
            message = "You are archiving an active owner group. Proceed?";
            // Show confirmation dialog
            return confirm(message);
        }


    }
</script>
