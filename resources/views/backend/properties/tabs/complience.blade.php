{{-- Hidden div for property ID --}}
<div id="hidden-property-id" class="d-none" data-property-id="{{ $propertyId }}"></div>

{{-- Compliance Types and Records --}}
<div class="dynamic_div">
    @foreach ($complianceTypes as $type)
        @php $heading = convert_to_uppercase(beautify_string($type->alias)); @endphp

        {{-- Compliance Type and Add Button --}}
        <div class="flex justify_between align_center my-3 w-100">
            <div class="sub_title">{{ $heading }}</div>
            <x-backend.forms.button
                name="Add {{ $heading }}"
                type="secondary"
                size="sm"
                isOutline="false"
                isLinkBtn="true"
                link="#"
                onClick="openComplianceModal({{ $type->id }})"
            />
        </div>

        {{-- Compliance Records Table for this Type --}}
        <div class="desktop_only">
            @foreach ($complianceRecords->where('compliance_type_id', $type->id) as $record)
                <h4>{{ $record->complianceType->name }}</h4>
                <table class="table rs_table">
                    <thead>
                        <tr>
                            @foreach ($record->complianceDetails as $detail)
                                <th>{{ capitalize_words($detail->key) }}</th>
                            @endforeach
                            <th>Expiry Date</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($record->complianceDetails as $detail)
                                <td>{{ $detail->value }}</td>
                            @endforeach
                            <td>{{ formatDate($record->expiry_date) }}</td>
                            <td class="img_thumb">
                                {{-- @if($record->photos)
                                    <img src="{{ asset('storage/' . $record->photos) }}" alt="image">
                                @else --}}
                                    <div class="img_thumb"><img src="{{ asset('asset/images/temp-property.webp') }}" alt="image"></div>
                                {{-- @endif --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </div>
    @endforeach
</div>

<!-- Modal for adding compliance (hidden initially) -->
<div class="modal" id="complianceModal" tabindex="-1" aria-labelledby="complianceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complianceModalLabel">Add Compliance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="complianceModalBody">
                <!-- Dynamic form content will be loaded here via Ajax -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="" class="btn btn-primary" id="submitComplianceForm">Save</button>
            </div>
        </div>
    </div>
</div>
