{{-- Compliance Types Header --}}
<div class="flex justify_between align_center w-100">
    @foreach ($complianceTypes as $type)
        <div class="sub_title">{{ $type->alias }}</div>
        <x-backend.forms.button
            name="Add {{ $type->alias }}"
            type="secondary"
            size="sm"
            isOutline="{{false}}"
            isLinkBtn={{true}}
            link="#"
            onClick="openComplianceModal({{ $type->id }})"
        />
    @endforeach
</div>

{{-- Compliance Records Table --}}
<div class="dynamic_div">
    <div class="desktop_only">
        @foreach ($complianceRecords as $record)
            <h4>{{ $record->complianceType->name }}</h4>
            <table class="table rs_table ">
                <thead>
                    <tr>
                        <th>Rating</th>
                        <th>Expiry Date</th>
                        <th>Image</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $record->rating }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->expiry_date)->format('d/m/Y') }}</td>
                        <td class="img_thumb">
                            @if($record->photos)
                                <img src="{{ asset('storage/' . $record->photos) }}" alt="image">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            @foreach ($record->complianceDetails as $detail)
                                <strong>{{ $detail->key }}:</strong> {{ $detail->value }}<br>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
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
                <button type="submit" id="submitComplianceForm" form="" class="btn btn-primary" id="submitComplianceForm">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
// Function to open the compliance modal and fetch the form
function openComplianceModal(complianceTypeId) {
    $.ajax({
        url: '{{ route('admin.compliance.type.form', ':complianceTypeId') }}'.replace(':complianceTypeId', complianceTypeId),
        type: 'GET',
        success: function(response) {
            // Load the dynamic form content into the modal body
            $('#complianceModalBody').html(response.content);

            // Find the form inside the modal and get its ID
            var formId = $('#complianceModalBody form').attr('id');

            // Set the form ID dynamically to the submit button
            $('#submitComplianceForm').attr('form', formId);

            // Show the modal
            $('#complianceModal').modal('show');
        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>

<div class="flex justify_between align_center w-100">
    <div class="sub_title">EPC</div>
    <x-backend.forms.button
        class=""
        name="Add EPC"
        type="secondary"
        size="sm"
        isOutline="{{false}}"
        isLinkBtn={{true}}
        link="https://#"
        onClick="copyHtml()"
    />
</div>

{{-- Complience page  --}}
<div class="dynamic_div">
    <div class="desktop_only">
        <table class="table rs_table ">
            <thead>
                <tr>
                    <th class="">Rating</th>
                    <th class="">Expiry Date</th>
                    <th class="">Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="">B</td>
                    <td class="">22/11/25</td>
                    <td class="img_thumb">
                        <img src="{{ asset('asset/images/temp-property.webp') }}" alt="image">
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="mobile_only">
        <div class="rs_mobile_table">
            <div class="data-row">
                <div class="tr_row">
                    <div class="">Rating</div>
                    <div class="">B</div>
                </div>
                <div class="tr_row">
                    <div class="">Expiry Date</div>
                    <div class="">22/11/25</div>
                </div>
                <div class="tr_row">
                    <div class="">Image</div>
                    <div class="img_thumb"><img src="{{ asset('asset/images/temp-property.webp') }}" alt="image"></div>
                </div>
            </div>
        </div>
    </div>
</div>
