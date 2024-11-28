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
{{-- Owners page  --}}
@php
    $headers = ['id','Name', 'Position', 'Phone', 'email', 'City'];
    $rows = [
        ['id' => 1, 'name' => 'John Doe', 'position' => 'Owner', 'phone' => '456798462', 'email' => 'john@example.com', 'city' => 'London'],
        ['id' => 1, 'name' => 'Jane Smith', 'position' => 'Landlord', 'phone' => '974511268', 'email' => 'jane@example.com', 'city' => 'Paris'],
        // Add more rows as needed
    ];
    $dropdownOptions = [
        ['label' => 'Edit', 'url' => '/edit'],
        ['label' => 'Delete', 'url' => '/delete'],
        // Add more options as needed
    ];
@endphp


<x-backend.dynamic-table-new  :headers="$headers" :rows="$rows" :dropdownOptions="$dropdownOptions" actionBtn={{True}} class="" />

