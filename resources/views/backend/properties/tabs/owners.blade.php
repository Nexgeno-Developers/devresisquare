{{-- <div id="hidden-property-id" style="display: none;" data-property-id="{{ $propertyId }}">
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
</div> --}}

{{-- Owners page  --}}
{{-- @php
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
 --}}



 @php
    // Table headers
    $headers = ['id', 'Name', 'Position', 'Phone', 'Email', 'City'];

    // Prepare rows from $ownerGroups
    $rows = [];

    if ($ownerGroups->isNotEmpty()) {
        foreach ($ownerGroups as $index => $ownerGroup) {
            // For each row, add the dropdown options dynamically
            $dropdownOptions = [
                [
                    'label' => 'Edit',
                    'class' => 'popup-tab-owners-edit',
                    'url' => route('admin.owner-groups.edit', $ownerGroup->id),  // Dynamic route URL for edit
                ],
                [
                    'label' => 'Delete',
                    'class' => 'popup-tab-owners-delete',
                    'url' => "javascript:void(0);",
                    // 'url' => route('admin.owner-groups.destroy', $ownerGroup->id),  // Dynamic route URL for delete
                    'onclick' => "confirmModal('" . route('admin.owner-groups.destroy', $ownerGroup->id) . "', responseHandler)"  // JavaScript function call for delete
                ]
            ];

            // Add this row to the table with its corresponding dropdown options
            $rows[] = [
                'id' => $index,  // Use the actual ID of the ownerGroup for identification
                'name' => $ownerGroup->contact->full_name ?? 'N/A',
                'position' => $ownerGroup->contact->category->name ?? 'N/A',  // Assuming category relationship exists
                'phone' => $ownerGroup->contact->phone ?? 'N/A',
                'email' => $ownerGroup->contact->email ?? 'N/A',
                'city' => $ownerGroup->contact->city ?? 'N/A',
            ];
        }
    }
@endphp

{{-- Hidden div for property ID --}}
<div id="hidden-property-id" style="display: none;" data-property-id="{{ $propertyId }}">
    @php
        // Debugging the propertyId
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>

{{-- Show table only if there is data --}}
@if($ownerGroups->isNotEmpty())
    {{-- Dynamic table component --}}
    <x-backend.dynamic-table-new
        :headers="$headers"
        :rows="$rows"
        :dropdownOptions="$dropdownOptions"
        actionBtn={{True}}
        class=""
    />
@else
    <p>No data available</p>
@endif
