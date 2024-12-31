<div id="mainForm">
    <form id="addTenancyForm" action="{{ route('admin.tenancies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="property_id" class="form-control" value="">

        <div class="form-group">
            <button type="button" class="btn btn-outline-primary btn-sm" id="addContactBtn">
                Add New Contact
            </button>
            <label for="contact_id">Contact</label>
            <select name="contact_id[]" id="contact_id" multiple class="form-control select2" required>
                @foreach ($contacts as $contact)
                    <option value="{{ $contact->id }}">{{ $contact->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-status required">
                        <label class="control-label" for="tenancies-status">Status</label>
                        <select id="tenancies-status" class="form-control" name="status"
                            aria-required="true">
                            <option value="Active">Active</option>
                            <option value="Archive">Archive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-sub_status required has-error">
                        <label class="control-label" for="tenancies-sub_status">Sub Status</label>
                        <input type="text" id="tenancies-sub_status" class="form-control" name="sub_status" aria-required="true" aria-invalid="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-move_in required">
                        <label class="control-label" for="tenancies-move_in">Move In</label>
                        <input type="date" id="tenancies-move_in" class="form-control" name="move_in"
                            min="2024-12-31" aria-required="true">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-move_out required">
                        <label class="control-label" for="tenancies-move_out">Move Out</label>
                        <input type="date" id="tenancies-move_out" class="form-control"
                            name="move_out" min="2024-12-31" aria-required="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-tenancy_length">
                        <label class="control-label" for="tenancies-tenancy_length">Tenancy Length</label>
                        <input type="date" id="tenancies-tenancy_length" class="form-control"
                            name="tenancy_length" min="2024-12-31">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-extension_date">
                        <label class="control-label" for="tenancies-extension_date">Extension Date</label>
                        <input type="date" id="tenancies-extension_date" class="form-control"
                            name="extension_date" min="2024-12-31">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="input-group">
                        <label>Rental Frequency</label><br>
                        <div class="form-group field-tenancies-price required">
                            <input type="text" id="tenancies-price" class="form-control"
                                name="Tenancies[price]" aria-required="true" wfd-id="id43">
                        </div>
                        <div class="form-group field-tenancies-frequency required">
                            <select id="tenancies-frequency" class="form-control" name="Tenancies[frequency]"
                                aria-required="true">
                                <option value="Monthly">Monthly</option>
                                <option value="Weekly">Weekly</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-estate_agent required has-success">
                        <label class="control-label" for="tenancies-estate_agent">Estate Agent</label>
                        <select id="tenancies-estate_agent" class="form-control" name="Tenancies[estate_agent]"
                            aria-required="true" aria-invalid="false">
                            <option value="Owner">Owner</option>
                            <option value="Tenant">Tenant</option>
                            <option value="Property Manager">Property Manager</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="float-end mt-3 btn btn-secondary">Save</button>
    </form>
</div>

<!-- Add Contact Form (Step 2) -->
<div id="addContactFormContainer" style="display: none;">
    <form id="addContactForm">
        @csrf
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
