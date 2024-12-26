<form id="owner-group-form" action="{{ route('admin.owner-groups.store_group') }}" method="POST">
    @csrf
    <input type="hidden" name="property_id" class="form-control" value="">

    <div class="form-group">
        <label for="contact_id">Contacts</label>
        <select name="contact_id[]" id="contact_id" class="form-control select2" multiple="multiple" required>
            @foreach($contacts as $contact)
                <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
            @endforeach
        </select>
    </div>

    <div id="contact-options" class="mt-3"></div>

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


<script>

    initSelect2('.select2');

    const contactSelect = $('#contact_id');
    const contactOptionsContainer = $('#contact-options');

    // Listen for changes in the contact dropdown
    contactSelect.on('change', function () {
        const selectedContacts = contactSelect.val() || [];
        contactOptionsContainer.empty();

        if (selectedContacts.length > 0) {
            // Add default label
            contactOptionsContainer.append(`
                <label class="mb-2">Select Main Contact</label>
            `);

            // Add radio buttons for each selected contact
            selectedContacts.forEach(contactId => {
                const contactName = contactSelect.find(`option[value="${contactId}"]`).text(); // Get the name from the option
                contactOptionsContainer.append(`
                    <div class="form-check">
                        <input type="radio" name="is_main" value="${contactId}" id="is_main_${contactId}" class="form-check-input">
                        <label for="is_main_${contactId}" class="form-check-label">${contactName}</label>
                    </div>
                `);
            });
        }
    });

    // Form submission validation
    $('form').on('submit', function(e) {
        if ($('input[name="is_main"]:checked').length === 0) {
            e.preventDefault(); // Prevent form submission
            alert('Please select a main contact.'); // Show alert message
        }
    });
</script>

