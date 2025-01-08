<div id="mainForm">
    @php
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
    @endphp
    <form id="addTenancyForm" action="{{ route('admin.tenancies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="property_id" class="form-control" value="">

        <div class="form-group">
            <button type="button" class="btn btn-outline-primary btn-sm" id="addContactBtn">
                Quick Add New Tenant
            </button>
            <label for="contact_id">Select Tenants</label>
            <select name="contact_id[]" id="contact_id" multiple class="form-control select2" required>
                @foreach ($tenants as $contact)
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
                            <option value="Active">Active</option>
                            <option value="Archive">Archive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancy-type required">
                        <label class="control-label" for="tenancy-type">Tenancy Type</label>
                        <select id="tenancy-type" class="form-control" aria-required="true" name="tenancy_type" required>
                            <option value="" disabled selected>Select Tenancy Type</option>
                            @foreach ($tenancyTypes as $tenancyType)
                                <option value="{{ $tenancyType->id }}">{{ $tenancyType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group field-tenancies-sub_status required has-error">
                        <label class="control-label" for="tenancies-sub_status">Sub Status</label>
                        <select id="tenancies-sub_status" class="form-control" name="sub_status" aria-required="true" required>
                            <option value="" disabled selected>Select Sub Status</option>
                            @foreach ($tenancySubStatuses as $subStatus)
                                <option value="{{ $subStatus->id }}">{{ $subStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <label>
                <input type="checkbox" name="periodic">
                Periodic
            </label><br>

            <label>
                <input type="checkbox" name="rolling_contract">
                Rolling Contract
            </label><br>

            <label>
                <input type="checkbox" name="renewal_exempt">
                Renewal Exempt
            </label><br>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="mb-3">
                    <label class="control-label" for="tenancies-move_in">Move In</label>
                    <input type="date" id="tenancies-move_in" class="form-control" name="move_in" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="control-label" for="tenancies-term_months">Term (Months)</label>
                    <input type="number" id="tenancies-term_months" class="form-control" name="term_months" min="0" pattern="^[0-9]+$" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="control-label" for="tenancies-term_days">Term (Days)</label>
                    <input type="number" id="tenancies-term_days" class="form-control" name="term_days" min="0" pattern="^[0-9]+$" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="control-label" for="tenancies-move_out">Move Out</label>
                    <input type="date" id="tenancies-move_out" class="form-control" name="move_out">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-tenancy_renewal_confirm_date">
                        <label class="control-label" for="tenancies-tenancy_renewal_confirm_date">Renewal Confirm Date</label>
                        <input type="date" id="tenancies-tenancy_renewal_confirm_date" class="form-control"
                            name="tenancy_renewal_confirm_date" min="2024-12-31">
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
                    <div class="form-group field-tenancies-rent">
                        <label class="control-label" for="tenancies-rent">Rent</label>
                        <input type="number" inputmode="numeric" pattern="[0-9]" id="tenancies-rent"
                            class="form-control" name="rent">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-tenancies-deposit">
                        <label class="control-label" for="tenancies-deposit">Deposit</label>
                        <input type="number" inputmode="numeric" pattern="[0-9]" id="tenancies-deposit"
                            class="form-control" name="deposit">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="depositType" class="form-label">Deposit Type</label>
                    <select class="form-select" id="depositType" name="deposit_type">
                        <option value="weeks_deposit">No of Weeks Deposit</option>
                        <option value="months_deposit">No of Months Deposit</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="depositNumber" class="form-label">Deposit Number (Weeks/Months)</label>
                    <input type="number" class="form-control" id="depositNumber" name="deposit_number" min="1" placeholder="Enter number of weeks or months" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="depositService" class="form-label">Deposit Held By</label>
                    <select class="form-select" id="depositService" name="deposit_held_by">
                        <option value="landlord_holding">Landlord Holding</option>
                        <option value="deposit_protection_service">Deposit Protection Service</option>
                        <option value="deposit_replacement_scheme">Deposit Replacement Scheme</option>
                        <option value="agent_holding_as_stakeholder">Agent Holding As Stake Holder</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="depositService" class="form-label">Deposit Service</label>
                    <select class="form-select" id="depositService" name="deposit_service">
                        <option value="tds_dps_number">*TDS or DPS Number</option>
                        <option value="number_of_scheme_or_number_of_reference">Name of the scheme Reference | Number of Scheme</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <div class="form-group field-property_manager required has-success">
                        <label class="control-label" for="property_manager">Property Manager</label>
                        <select name="property_manager[]" id="property_manager" multiple class="form-control select2"
                            required>
                            @foreach ($property_managers as $property_manager)
                                <option value="{{ $property_manager->id }}">{{ $property_manager->full_name }}</option>
                            @endforeach
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
    // function initializeForm() {
    //     const moveInInput = document.getElementById('tenancies-move_in');
    //     const termInput = document.getElementById('tenancies-term');
    //     const termUnitSelect = document.getElementById('tenancies-term_unit');
    //     const moveOutInput = document.getElementById('tenancies-move_out');

    //     // Only initialize if the elements exist
    //     if (moveInInput && termInput && termUnitSelect && moveOutInput) {
    //         // Function to update the move-out date based on move-in date, term, and term unit
    //         function updateMoveOutDate() {
    //             const moveInDate = new Date(moveInInput.value);
    //             const term = parseInt(termInput.value);
    //             const termUnit = termUnitSelect.value;

    //             if (moveInDate instanceof Date && !isNaN(moveInDate) && term && termUnit) {
    //                 let moveOutDate;

    //                 if (termUnit === 'months') {
    //                     // Add months
    //                     moveOutDate = new Date(moveInDate.setMonth(moveInDate.getMonth() + term));
    //                 } else if (termUnit === 'days') {
    //                     // Add days
    //                     moveOutDate = new Date(moveInDate.setDate(moveInDate.getDate() + term));
    //                 }

    //                 // Set the move-out date to the calculated date
    //                 moveOutInput.value = moveOutDate.toISOString().split('T')[0];
    //             }
    //         }

    //         // Remove existing event listeners if any (this helps avoid re-binding the same listeners)
    //         moveInInput.removeEventListener('change', updateMoveOutDate);
    //         termInput.removeEventListener('input', updateMoveOutDate);
    //         termUnitSelect.removeEventListener('change', updateMoveOutDate);

    //         // Add event listeners for changes in move-in date, term, or term unit
    //         moveInInput.addEventListener('change', updateMoveOutDate);
    //         termInput.addEventListener('input', updateMoveOutDate);
    //         termUnitSelect.addEventListener('change', updateMoveOutDate);

    //         // Initial calculation if values are already present
    //         updateMoveOutDate();
    //     }
    // }

    function initializeForm() {
        const moveInInput = document.getElementById('tenancies-move_in');
        const termMonthsInput = document.getElementById('tenancies-term_months');
        const termDaysInput = document.getElementById('tenancies-term_days');
        const moveOutInput = document.getElementById('tenancies-move_out');

        if (!moveInInput || !termMonthsInput || !termDaysInput || !moveOutInput) return;

        // Function to calculate the "Move Out" date
        function calculateMoveOutDate() {
            const moveInDate = new Date(moveInInput.value);
            const termMonths = parseInt(termMonthsInput.value, 10) || 0; // Default to 0 if empty
            const termDays = parseInt(termDaysInput.value, 10) || 0; // Default to 0 if empty

            if (isNaN(moveInDate.getTime())) {
                moveOutInput.value = '';
                return;
            }

            // Add months and days to the "Move In" date
            const resultDate = new Date(moveInDate);
            if (termMonths > 0) {
                resultDate.setMonth(resultDate.getMonth() + termMonths);
                // Subtract 1 day for tenancy default behavior
                resultDate.setDate(resultDate.getDate() - 1);
            }
            if (termDays > 0) resultDate.setDate(resultDate.getDate() + termDays);

            // Set the calculated "Move Out" date
            moveOutInput.value = resultDate.toISOString().split('T')[0];
        }
        // Function to calculate the term in months and days based on Move In and Move Out dates
        function recalculateTerm() {
            const moveInDate = new Date(moveInInput.value);
            const moveOutDate = new Date(moveOutInput.value);

            if (isNaN(moveInDate.getTime()) || isNaN(moveOutDate.getTime())) return;

            const timeDifference = moveOutDate - moveInDate; // Difference in milliseconds
            const daysDifference = timeDifference / (1000 * 3600 * 24); // Convert to days

            const months = Math.floor(daysDifference / 30); // Approximate months
            const remainingDays = daysDifference % 30; // Remainder days

            // Update the term input fields
            termMonthsInput.value = months;
            termDaysInput.value = remainingDays;
        }

        // Function to validate the "Move Out" date and ensure it's after the "Move In" date
        function validateMoveOutDate() {
            const moveInDate = new Date(moveInInput.value);
            const moveOutDate = new Date(moveOutInput.value);

            if (isNaN(moveInDate.getTime()) || isNaN(moveOutDate.getTime())) return;

            if (moveOutDate <= moveInDate) {
                // Show error message or reset the Move Out date if it's invalid
                alert("Move Out Date must be greater than Move In Date.");
                moveOutInput.value = ''; // Reset Move Out Date
            }
        }

        // Function to ensure that the Term fields cannot have negative values
        function validateTermInputs() {
            const termMonths = parseInt(termMonthsInput.value, 10);
            const termDays = parseInt(termDaysInput.value, 10);

            if (termMonths < 0) termMonthsInput.value = 0;
            if (termDays < 0) termDaysInput.value = 0;
        }

        // Add event listeners to update the "Move Out" date on input change
        moveInInput.addEventListener('change', () => {
            // Only calculate Move Out if either termMonths or termDays is set
            if (termMonthsInput.value > 0 || termDaysInput.value > 0) {
                calculateMoveOutDate();
            }
        });

        // moveInInput.addEventListener('change', calculateMoveOutDate);
        termMonthsInput.addEventListener('input', (e)=> {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
            validateTermInputs();
            calculateMoveOutDate();
        });
        termDaysInput.addEventListener('input', (e)=> {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
            validateTermInputs();
            calculateMoveOutDate();
        });
        moveOutInput.addEventListener('change', () => {
            calculateMoveOutDate();
            recalculateTerm();
            validateMoveOutDate(); // Validate if Move Out Date is after Move In Date
        });

        // Initial calculation if values are already filled
        calculateMoveOutDate();
    }

    // Initialize the form only once the content is fully loaded
    initializeForm();
    // });
</script>
