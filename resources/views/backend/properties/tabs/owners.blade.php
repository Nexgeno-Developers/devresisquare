@php
    // Table headers
    $headers = ['id' => 'ID', 'name' => 'Name', 'position' => 'Position', 'phone' => 'Phone', 'email' => 'Email', 'city' => 'City'];

    // Prepare rows from $ownerGroups
    $rows = [];
    $options = [];

    if ($ownerGroups->isNotEmpty()) {
        foreach ($ownerGroups as $index => $ownerGroup) {
            // Add the dropdown options dynamically for each row
            $options[] = [
                [
                    'label' => 'Edit',
                    'class' => 'popup-tab-owners-edit',
                    'url' => "javascript:void(0);",
                    'onclick' => "smallModal('" . route('admin.owner-groups.edit', $ownerGroup->id) . "', 'Edit Owner');"
                ],
                [
                    'label' => 'Delete',
                    'class' => 'popup-tab-owners-delete',
                    'url' => "javascript:void(0);",
                    'onclick' => "confirmModal('" . route('admin.owner-groups.destroy', $ownerGroup->id) . "', responseHandler)"  // JavaScript function call for delete
                ]
            ];

            // Add the row data for the table
            $rows[] = [
                'id' => $index + 1,  // Use the index for ID in the row
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
        // Debugging the propertyId (for development purposes)
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>

{{-- Show table only if there is data --}}
@if($ownerGroups->isNotEmpty())
    {{-- Table rendering --}}
    <div class="dynamic_div owners_table">
        <div class="desktop_only">
            <table class="table table-striped rs_table">
                <thead>
                    <tr>
                        @foreach($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $index => $row)
                        <tr>
                            @foreach($headers as $key => $header)
                                <td>{{ $row[$key] }}</td>
                            @endforeach
                            <td style="display: flex; flex-direction: column;">
                                {{-- Action buttons --}}
                                @foreach($options[$index] as $option)
                                    <a href="{{ $option['url'] }}" class="{{ $option['class'] }}"
                                    @isset($option['onclick']) onclick="{{ $option['onclick'] }}" @endisset>
                                    {{ $option['label'] }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mobile_only">
            <div class="rs_mobile_table">
                @foreach($rows as $row)
                    <div class="data-row">
                        @foreach($headers as $key => $header)
                            <div class="tr_row">
                                @if ($key !== 'id')
                                    <div>{{ $header }}</div>
                                    <div class="text_right fw_normal">{{ $row[$key] }}</div>
                                @endif
                            </div>
                        @endforeach
                        <div class="flex gap-3 justify-content-end">
                            @foreach($options[$index] as $option)
                                <a href="{{ $option['url'] }}" class="{{ $option['class'] }} btn btn_secondary"
                                @isset($option['onclick']) onclick="{{ $option['onclick'] }}" @endisset>
                                    {{ $option['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@else
    <p>No data available</p>
@endif