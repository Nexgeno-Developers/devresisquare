<div id="hidden-property-id" style="display: none;" data-property-id="{{ $propertyId }}">
    @php
        // Debugging the propertyId
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>

<div class="owner-groups-list">
    @foreach($ownerGroups as $ownerGroup)
        <div class="owner-group">
            <!-- Mapped contacts' full_name -->
            <p><strong>{{ $ownerGroup->contact->full_name }}</strong></p>

            <!-- Mapped contacts' category_id (assuming category_id maps to contacts_categories table) -->
            <p><strong>{{ $ownerGroup->contact->category->name ?? 'N/A' }}</strong> </p>

            <!-- Mapped contacts' phone -->
            <p><strong>Phone:</strong> {{ $ownerGroup->contact->phone }}</p>

            <!-- Mapped contacts' email -->
            <p><strong>Email:</strong> {{ $ownerGroup->contact->email }}</p>

            <!-- Mapped contacts' address details -->
            <p><strong>Address:</strong> {{ $ownerGroup->contact->address_line_1 }},
                {{ $ownerGroup->contact->address_line_2 }},
                {{ $ownerGroup->contact->city }},
                {{ $ownerGroup->contact->postcode }},
                {{ $ownerGroup->contact->country }}
            </p>

            <!-- Mapped contacts' city -->
            <p><strong>City:</strong> {{ $ownerGroup->contact->city }}</p>
        </div>
    @endforeach
</div>
