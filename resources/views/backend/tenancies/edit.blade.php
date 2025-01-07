@php
    // echo'<pre>';
    // var_dump($tenancy);
    // echo'</pre>';

    // Check if the properties are set before storing them in variables
    $status = isset($tenancy->status) ? $tenancy->status : null;
    $sub_status = isset($tenancy->sub_status) ? $tenancy->sub_status : null;
    $move_in = isset($tenancy->move_in) ? $tenancy->move_in : null;
    $move_out = isset($tenancy->move_out) ? $tenancy->move_out : null;
    $tenancy_length = isset($tenancy->tenancy_length) ? $tenancy->tenancy_length : null;
    $extension_date = isset($tenancy->extension_date) ? $tenancy->extension_date : null;
    $price = isset($tenancy->price) ? $tenancy->price : null;
    $deposit = isset($tenancy->deposit) ? $tenancy->deposit : null;
    $frequency = isset($tenancy->frequency) ? $tenancy->frequency : null;

    $statuses = [
        'under_negotiation' => 'Under Negotiation',
        'offer_accepted' => 'Offer Accepted',
        'admin_to_approve' => 'Admin To Approve',
        'accounts_to_process' => 'Accounts To Process',
        'current_tenancy' => 'Current Tenancy',
        'current_tenancy_on_notice' => 'Current Tenancy (On Notice)',
        'aborted' => 'Aborted',
        'offer_rejected' => 'Offer Rejected',
        'offer_rejected_refund_request' => 'Offer Rejected – Refund Request',
        'checked_out' => 'Checked Out',
        'checked_out_deposit_dispute' => 'Checked Out – Deposit Dispute',
        'checked_out_deposit_settled' => 'Checked Out – Deposit Settled',
        'archive' => 'Archive',
    ];

    $sub_status = isset($tenancy->sub_status) ? $tenancy->sub_status : null;
@endphp

<div id="mainForm">
    <form id="addTenancyForm" action="{{ route('admin.tenancies.update', $tenancy->id) }}" method="POST"
        enctype="multipart/form-data">
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
                        <select id="tenancies-status" class="form-control" name="status" aria-required="true">
                            <option value="Active" {{ isset($status) && $status == 'Active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="Archive" {{ isset($status) && $status == 'Archive' ? 'selected' : '' }}>
                                Archive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancy-type required">
                        <label class="control-label" for="tenancy-type">Tenancy Type</label>
                        <select  id="tenancy-type" class="form-control" aria-required="true" name="tenancy_type">
                            <option value="AST">AST</option>
                            <option value="Common Law">Common Law</option>
                            <option value="Company">Company</option>
                            <option value="Short Let - AST">Short Let - AST</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group field-tenancies-sub_status required has-error">
                        <label class="control-label" for="tenancies-sub_status">Sub Status</label>
                        <select id="tenancies-sub_status" class="form-control" name="sub_status" aria-required="true"
                            aria-invalid="true">
                            <option value="" disabled {{ is_null($sub_status) ? 'selected' : '' }}>Select Sub
                                Status</option>
                            @foreach ($statuses as $key => $value)
                                <option value="{{ $key }}" {{ $key == $sub_status ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-move_in required">
                            <label class="control-label" for="tenancies-move_in">Move In</label>
                            <input type="date" id="tenancies-move_in" class="form-control" name="move_in"
                                aria-required="true" value="{{ isset($move_in) ? $move_in : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-term required">
                            <label class="control-label" for="tenancies-term">Term</label>
                            <input type="number" id="tenancies-term" class="form-control" name="term" min="1"
                                value="{{ isset($term) ? $term : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-term_unit required">
                            <label class="control-label" for="tenancies-term_unit">Term Unit</label>
                            <select id="tenancies-term_unit" class="form-control" name="term_unit">
                                <option value="months"
                                    {{ isset($term_unit) && $term_unit == 'months' ? 'selected' : '' }}>Months</option>
                                <option value="days"
                                    {{ isset($term_unit) && $term_unit == 'days' ? 'selected' : '' }}>Days</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-move_out required">
                            <label class="control-label" for="tenancies-move_out">Move Out</label>
                            <input type="date" id="tenancies-move_out" class="form-control" name="move_out"
                                aria-required="true" value="{{ isset($move_out) ? $move_out : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-tenancy_length">
                            <label class="control-label" for="tenancies-tenancy_length">Tenancy Length (in
                                month)</label>
                            <input type="number" inputmode="numeric" pattern="[0-9]" id="tenancies-tenancy_length"
                                class="form-control" name="tenancy_length"
                                value="{{ isset($tenancy_length) ? $tenancy_length : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-extension_date">
                            <label class="control-label" for="tenancies-extension_date">Extension Date</label>
                            <input type="date" id="tenancies-extension_date" class="form-control"
                                name="extension_date" min=""
                                value="{{ isset($extension_date) ? $extension_date : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-price">
                            <label class="control-label" for="tenancies-price">Rent</label>
                            <input type="number" inputmode="numeric" pattern="[0-9]" id="tenancies-price"
                                class="form-control" name="price" value="{{ isset($price) ? $price : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-tenancies-deposit">
                            <label class="control-label" for="tenancies-price">Deposit</label>
                            <input type="number" inputmode="numeric" pattern="[0-9]" id="tenancies-deposit"
                                class="form-control" name="deposit" value="{{ isset($deposit) ? $deposit : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="input-group">
                            <label>Rental Frequency</label><br>
                            <div class="form-group field-tenancies-frequency required">
                                <select id="tenancies-frequency" class="form-control" name="frequency"
                                    aria-required="true">
                                    <option value="Monthly"
                                        {{ isset($frequency) && $frequency == 'Monthly' ? 'selected' : '' }}>Monthly
                                    </option>
                                    <option value="Weekly"
                                        {{ isset($frequency) && $frequency == 'Weekly' ? 'selected' : '' }}>Weekly
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="form-group field-property_manager required has-success">
                            <label class="control-label" for="property_manager">Property Manager</label>
                            <select name="property_manager[]" id="property_manager" multiple class="form-control select2" required>
                                @foreach ($property_managers as $property_manager)
                                    <option value="{{ $property_manager->id }}">{{ $property_manager->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
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
        <input type="hidden" class="form-control" id="category_id" name="category_id" value="3">
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
    // document.addEventListener('DOMContentLoaded', function () {
        // Function to initialize the popup form logic
        function initializeForm() {
            const moveInInput = document.getElementById('tenancies-move_in');
            const termInput = document.getElementById('tenancies-term');
            const termUnitSelect = document.getElementById('tenancies-term_unit');
            const moveOutInput = document.getElementById('tenancies-move_out');

            // Only initialize if the elements exist
            if (moveInInput && termInput && termUnitSelect && moveOutInput) {
                // Function to update the move-out date based on move-in date, term, and term unit
                function updateMoveOutDate() {
                    const moveInDate = new Date(moveInInput.value);
                    const term = parseInt(termInput.value);
                    const termUnit = termUnitSelect.value;

                    if (moveInDate instanceof Date && !isNaN(moveInDate) && term && termUnit) {
                        let moveOutDate;

                        if (termUnit === 'months') {
                            // Add months
                            moveOutDate = new Date(moveInDate.setMonth(moveInDate.getMonth() + term));
                        } else if (termUnit === 'days') {
                            // Add days
                            moveOutDate = new Date(moveInDate.setDate(moveInDate.getDate() + term));
                        }

                        // Set the move-out date to the calculated date
                        moveOutInput.value = moveOutDate.toISOString().split('T')[0];
                    }
                }

                // Remove existing event listeners if any (this helps avoid re-binding the same listeners)
                moveInInput.removeEventListener('change', updateMoveOutDate);
                termInput.removeEventListener('input', updateMoveOutDate);
                termUnitSelect.removeEventListener('change', updateMoveOutDate);

                // Add event listeners for changes in move-in date, term, or term unit
                moveInInput.addEventListener('change', updateMoveOutDate);
                termInput.addEventListener('input', updateMoveOutDate);
                termUnitSelect.addEventListener('change', updateMoveOutDate);

                // Initial calculation if values are already present
                updateMoveOutDate();
            }
        }

        // Initialize the form only once the content is fully loaded
        initializeForm();
    // });
</script>
