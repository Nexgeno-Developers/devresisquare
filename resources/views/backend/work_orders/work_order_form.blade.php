<div class="modal fade" id="workOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="workOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workOrderModalLabel">Work Order Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="workOrderForm" action="{{ route('admin.work_orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="repair_issue_id" value="{{ $repairIssue->id }}">
                    <input type="hidden" name="work_order_id" value="{{ $repairIssue->workOrder->id ?? '' }}">

                    <div class="row">
                        <h6 class="display-6">Job Details</h6>
                        <hr>
                        <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Property Address</label>
                                <p class="set-property-address"></p>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Job Status</label>
                                <select required name="job_status" class="form-control">
                                    <option value="Quote" {{ old('job_status', $repairIssue->workOrder->job_status ?? '') == 'Quote' ? 'selected' : '' }}>Quote</option>
                                    <option value="Awarded" {{ old('job_status', $repairIssue->workOrder->job_status ?? '') == 'Awarded' ? 'selected' : '' }}>Awarded</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Job Type</label>
                                <select required name="job_type_id" id="jobTypeSelect" class="form-control">
                                    <option value="">Select Job Type</option>
                                    @foreach ($jobTypes as $type)
                                        <option value="{{ $type->id }}" 
                                            {{ old('job_type_id', $repairIssue->workOrder->job_type_id ?? '') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Job Sub Type</label>
                                <select name="job_sub_type_id" id="jobSubTypeSelect" class="form-control">
                                    <option disabled aria-disabled="true" value="">Select Job Sub Type</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="col-md-12 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Job Scope</label>
                                <textarea required name="job_scope" class="form-control">{{ old('job_scope', $repairIssue->workOrder->job_scope ?? $repairIssue->description ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Tentative Initiation Date of Job</label>
                                <input required type="date" name="tentative_start_date" class="form-control" value="{{ old('tentative_start_date', $repairIssue->workOrder->tentative_start_date ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Tentative Completion Date of Job</label>
                                <input type="date" name="tentative_end_date" class="form-control" value="{{ old('tentative_end_date', $repairIssue->workOrder->tentative_end_date ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Booked Date</label>
                                <input type="date" name="booked_date" class="form-control" value="{{ old('booked_date', $repairIssue->workOrder->booked_date ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-md-5">
                        <h6 class="display-6">Invoice Details</h6>
                        <hr>

                        {{-- <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label d-block">Invoice To</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="invoice_to" value="Landlord" id="invoice_landlord" required {{ old('invoice_to', $repairIssue->workOrder->invoice_to ?? '') == 'Landlord' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invoice_landlord">Landlord</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="invoice_to" value="Tenant" id="invoice_tenant" {{ old('invoice_to', $repairIssue->workOrder->invoice_to ?? '') == 'Tenant' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invoice_tenant">Tenant</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="invoice_to" value="Company" id="invoice_company" {{ old('invoice_to', $repairIssue->workOrder->invoice_to ?? '') == 'Company' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invoice_company">
                                        Company
                                      </label>                                      
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-4 mb-3">
                            <div class="form-group"> 
                                <label class="form-label d-block">Invoice To</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="invoice_to" value="Landlord" id="invoice_landlord" required {{ old('invoice_to', $repairIssue->workOrder->invoice_to ?? '') == 'Landlord' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invoice_landlord">Landlord</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="invoice_to" value="Tenant" id="invoice_tenant" {{ old('invoice_to', $repairIssue->workOrder->invoice_to ?? '') == 'Tenant' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invoice_tenant">Tenant</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="invoice_to" value="Company" id="invoice_company" {{ old('invoice_to', $repairIssue->workOrder->invoice_to ?? '') == 'Company' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="invoice_company">
                                        Company
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dynamic Dropdown Container -->
                        <div id="invoiceToContainer" class="col-md-4 mb-3"></div>

                        <!-- Contact Details (Hidden Initially) -->
                        <div id="contactDetails" class="mt-3 col-md-4" style="display: none;">
                            {{-- <h6>Contact Details</h6>
                            <p><strong>Name:</strong> <span id="contactName"></span></p> --}}
                            <p><strong>Address:</strong> <span id="contactAddress"></span></p>
                            <p><strong>Email:</strong> <span id="contactEmail"></span></p>
                            <p><strong>Phone:</strong> <span id="contactPhone"></span></p>
                        </div>

                        <!-- Hidden Input for Property ID -->
                        <input type="hidden" id="property_id" value="{{ $repairIssue->property->id }}">
                        

                        {{-- <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Quote Attachment</label>
                                <input type="file" name="quote_attachment" class="form-control">
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-group"> 
                                    <label class="form-label">Actual Cost</label>
                                    <input required type="number" step="0.01" name="actual_cost" class="form-control" value="{{ old('actual_cost', $repairIssue->workOrder->actual_cost ?? '') }}">
                                </div>
                            </div>

                            <div class="col mb-3">
                                <div class="form-group"> 
                                    <label class="form-label">Charge to Landlord</label>
                                    <input type="number" step="0.01" name="charge_to_landlord" class="form-control" value="{{ old('charge_to_landlord', 
                                    $repairIssue->workOrder->charge_to_landlord ?? '') }}">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-4 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Estimated Cost</label>
                                <input required type="number" step="0.01" name="estimated_cost" class="form-control" value="{{ old('estimated_cost', $repairIssue->workOrder->estimated_cost ?? '') }}">
                            </div>
                        </div> --}}

                        <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Payment Terms</label>
                                <select required name="payment_by" class="form-control">
                                    <option value="Landlord"  {{ old('payment_by', $repairIssue->workOrder->payment_by ?? '') == 'Landlord' ? 'selected' : '' }}>Landlord</option>
                                    <option value="Tenant"  {{ old('payment_by', $repairIssue->workOrder->payment_by ?? '') == 'Tenant' ? 'selected' : '' }}>Tenant</option>
                                    <option value="Company"  {{ old('payment_by', $repairIssue->workOrder->payment_by ?? '') == 'Company' ? 'selected' : '' }}>Company</option>
                                </select>
                            </div>
                        </div>
                        <!-- Status Dropdown (Dynamically Updated) -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Status</label>
                                <select required name="status" id="statusSelect" class="form-control">
                                    <!-- Status options will be dynamically inserted here -->
                                </select>
                            </div>
                        </div>

                        <!-- Hidden Field to Store the Preselected Status -->
                        <input type="hidden" id="existingStatus" value="{{ old('status', $repairIssue->workOrder->status ?? '') }}">

                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <div class="form-group"> 
                                    <label class="form-label">Date</label>
                                    <input required type="datetime-local" name="date_time" id="date" class="form-control" value="{{ old('date_time', $repairIssue->workOrder->date_time ?? '') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group"> 
                                <label class="form-label">Extra Notes</label>
                                <textarea required name="extra_notes" class="form-control">{{ old('extra_notes', $repairIssue->workOrder->extra_notes ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Work Order</button>
                        <button type="button" class="btn btn-info" id="generateInvoiceBtn">Generate Invoice</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
