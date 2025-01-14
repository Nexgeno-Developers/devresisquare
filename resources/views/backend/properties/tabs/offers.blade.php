{{-- Hidden div for property ID --}}
<div id="hidden-property-id" class="d-none" data-property-id="{{ $propertyId }}">
    @php
        // Debugging the propertyId
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>

<div class="accordion" id="offersAccordion">
    @if(isset($offers))

    @foreach($offers as $key => $offer)
    @php
        // Check if tenant_details is already an array or string
        $tenantDetails = is_string($offer->tenant_details) ? json_decode($offer->tenant_details, true) : $offer->tenant_details;

        // Collect the contact IDs
        $contactIds = array_keys($tenantDetails);  // This gives an array of contact IDs (e.g., [12, 15, 18])

        // Retrieve the contacts from the database using the contact IDs
        $contacts = \App\Models\Contact::whereIn('id', $contactIds)->get();

        // Find the main person (the first contact in tenant_details)
        $mainPersonId = key($tenantDetails);  // Get the first contact ID with the main person flag
        $mainPerson = $contacts->firstWhere('id', $mainPersonId);

        // Get the other members (excluding the main person)
        $otherMembers = $contacts->reject(fn($contact) => $contact->id == $mainPersonId)->all();
    @endphp

    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-{{ $offer->id }}">
            <button class="accordion-button {{ $key > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $offer->id }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $offer->id }}">
                Offer #{{ $key + 1 }} - {{ $offer->status }} (Main Person: {{ $mainPerson->full_name ?? 'N/A' }})
            </button>
        </h2>
        <div id="collapse-{{ $offer->id }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $offer->id }}" data-bs-parent="#offersAccordion">
            <div class="accordion-body">
                <!-- Main Person Section -->
                @if($mainPerson)
                    <h5>Main Person</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Employment Status</th>
                                <th>Price</th>
                                <th>Deposit</th>
                                <th>Term</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $mainPerson->full_name }}</td>
                                <td>{{ $mainPerson->phone }}</td>
                                <td>{{ $mainPerson->email }}</td>
                                <td>{{ $mainPerson->details->employment_status ?? 'N/A' }}</td>
                                <td>{{ $offer->price }}</td>
                                <td>{{ $offer->deposit }}</td>
                                <td>{{ $offer->term }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif

                <!-- Other Members Section -->
                @if(!empty($otherMembers))
                    <h5>Other Members</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Employment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($otherMembers as $member)
                            <tr>
                                <td>{{ $member->full_name }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->details->employment_status ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm make-main-btn" data-id="{{ $offer->id }}" data-member="{{ json_encode($member) }}">Set as Main</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        @if ($offer->status !== 'Accepted' && $offer->status !== 'Rejected')
                            <button class="btn btn-success btn-sm status-btn" data-id="{{ $offer->id }}" data-status="Accepted">Accept Offer</button>
                            <button class="btn btn-danger btn-sm status-btn" data-id="{{ $offer->id }}" data-status="Rejected">Reject Offer</button>
                        @endif
                    </div>
                    <span class="badge
                        @if ($offer->status == 'Accepted')
                            bg-success
                        @elseif ($offer->status == 'Rejected')
                            bg-danger
                        @else
                            bg-warning
                        @endif
                    ">
                        Status: <span id="status-{{ $offer->id }}">{{ $offer->status }}</span>
                    </span>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
