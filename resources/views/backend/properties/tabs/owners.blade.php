{{-- Hidden div for property ID --}}
<div id="hidden-property-id" style="display: none;" data-property-id="{{ $propertyId }}">
    @php
        // Debugging the propertyId (for development purposes)
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>

{{-- Show table only if there is data --}}
@if($ownerGroups->isNotEmpty())
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sr No.</th>
            <th>Group Name</th>
            <th>Purchase Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ownerGroups as $index => $ownerGroup)
            <!-- Main Row -->
            <tr>
                <!-- Sr No -->
                <td>{{ $index + 1 }}</td>

                <!-- Group Name -->
                <td>
                    @php
                        $contacts = $ownerGroup->ownerGroupContacts->pluck('contact.full_name')->toArray();
                        $groupName = count($contacts) > 2
                            ? implode(' & ', array_slice($contacts, 0, 2)) . ' and others'
                            : implode(' & ', $contacts);
                    @endphp
                    <span class="group-name" style="cursor: pointer;" data-toggle="collapse" data-target="#details-{{ $ownerGroup->id }}" aria-expanded="false" aria-controls="details-{{ $ownerGroup->id }}">
                        {{ $groupName }}
                    </span>
                </td>

                <!-- Purchase Date -->
                <td>{{ $ownerGroup->purchased_date ?? 'N/A' }}</td>

                <!-- Status -->
                <td>{{ ucfirst($ownerGroup->status ?? 'unknown') }}</td>

                <!-- Action -->
                <td>
                    <button class="btn btn-sm btn-primary" onclick="viewDetails({{ $ownerGroup->id }})">View</button>
                </td>
            </tr>

            <!-- Expandable Row for Contact Details -->
            <tr class="collapse" id="details-{{ $ownerGroup->id }}">
                <td colspan="5">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ownerGroup->ownerGroupContacts as $contactIndex => $contact)

                                <tr>
                                    <!-- Sr No -->
                                    <td>{{ $contactIndex + 1 }}</td>

                                    <!-- Name -->
                                    <td>
                                        {{ $contact->contact->full_name }}
                                        @if($contact->is_main)
                                            <span class="badge text-bg-success">Main</span>
                                        @endif
                                    </td>

                                    <!-- Position -->
                                    <td>
                                        {{ $contact->category->name ?? 'N/A' }}
                                    </td>


                                    <!-- Phone -->
                                    <td>{{ $contact->contact->phone }}</td>

                                    <!-- Email -->
                                    <td>{{ $contact->contact->email }}</td>

                                    <!-- City -->
                                    <td>{{ $contact->contact->city }}</td>

                                    <!-- Actions -->
                                    <td>
                                        @if(!$contact->is_main)
                                        <button class="btn btn-sm btn-success" onclick="setAsMain({{ $contact->id }}, {{ $ownerGroup->id }})">
                                            Set as Main
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- JavaScript functions -->
<script>
    function viewDetails(groupId) {
        alert('Details for Group ID: ' + groupId);
        // Implement further actions like opening a modal or redirecting
    }

    function setAsMain(contactId, groupId) {
        if (confirm('Are you sure you want to set this contact as the main contact?')) {
            // Perform the action via AJAX or redirect
            alert('Contact ID: ' + contactId + ' set as Main for Group ID: ' + groupId);
        }
    }
</script>



@else
    <p>No data available</p>
@endif
