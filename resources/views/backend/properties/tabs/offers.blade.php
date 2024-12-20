{{-- Hidden div for property ID --}}
<div id="hidden-property-id" style="display: none;" data-property-id="{{ $propertyId }}">
    @php
        // Debugging the propertyId
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>
<div class="accordion" id="offersAccordion">
    @foreach($offers as $key => $offer)
    @php
        // Find the main person
        $mainPerson = collect($offer->tenant_details)->firstWhere('mainPerson', true);

        // Get the other members (excluding the main person)
        $otherMembers = collect($offer->tenant_details)->reject(fn($member) => $member['mainPerson'] ?? false)->all();
    @endphp

    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-{{ $offer->id }}">
            <button class="accordion-button {{ $key > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $offer->id }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $offer->id }}">
                Offer #{{ $key + 1 }} - {{ $offer->status }} (Main Person: {{ $mainPerson['tenantName'] }})
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
                                <td>{{ $mainPerson['tenantName'] }}</td>
                                <td>{{ $mainPerson['tenantPhone'] }}</td>
                                <td>{{ $mainPerson['tenantEmail'] }}</td>
                                <td>{{ $mainPerson['employmentStatus'] }}</td>
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
                                <td>{{ $member['tenantName'] }}</td>
                                <td>{{ $member['tenantPhone'] }}</td>
                                <td>{{ $member['tenantEmail'] }}</td>
                                <td>{{ $member['employmentStatus'] }}</td>
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
</div>
