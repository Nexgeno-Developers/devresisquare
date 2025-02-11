@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Edit Repair Issue</h1>

    <form action="{{ route('admin.property_repairs.update', $repairIssue->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <!-- Category Display Card: Read-only view with current selection -->
                <div class="card mb-3" id="category-display-card">
                    <div class="card-header">Property
                        <!-- Change Property Button (Initially hidden) -->
                        <button id="change_property_button" class="btn btn-info mt-3 float-end" style="display: none;">Change Property</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group text-center mt-lg-0 mt-4">
                            <div class="set-display-none" id="search_property_section" style="display: none;">
                                <label class="mb-2" for="search_property1">Search And Select Property</label>

                                <!-- Search Input (Initially hidden) -->
                                <div class="form-group">
                                    <div class="rs_input input_search position-relative">
                                        <div class="right_icon position-absolute top-50 translate-middle-y end-0 pe-2">
                                            <i class="bi bi-search"></i>
                                        </div>
                                        <input type="text" id="search_property1" placeholder="Search Property" class="form-control search_property" />
                                    </div>
                                    <div id="error_message" class="mt-1 text-danger" style="display: none;"></div>

                                    <!-- Cancel Button for Property Change (Initially hidden) -->
                                    <button id="cancel_property_change" class="btn btn-warning mt-3" style="display: none;">Cancel</button>
                                </div>
                            </div>

                            <!-- Search Results -->
                            <ul id="property_results" class="list-group mt-2"></ul>
                            <!-- Hidden field for selected property IDs -->
                            <input type="hidden" id="selected_properties" name="property_id" value="{{ json_encode(is_array($repairIssue->property->id) ? $repairIssue->property->id : [$repairIssue->property->id]) }}">

                            {{-- <input type="hidden" id="selected_properties" name="property_id" value="{{ json_encode(isset($repairIssue->property->id) ? $repairIssue->property->id : []) }}"> --}}
                        </div>
                    </div>
                    <!-- Dynamic Property Table -->
                    <div id="dynamic_property_table" class="d-none mt-4">
                        @php
                            $headers = ['Address', 'Type', 'Availability', 'Actions'];
                            $rows = []; // Initially empty
                        @endphp
                        <x-backend.dynamic-table :headers="$headers" :rows="$rows" class="contact_add_property" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Category Display Card: Read-only view with current selection -->
                <div class="card mb-3" id="category-display-card">
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="repair_category_display">Category</label>
                            <input readonly type="text" class="form-control" id="repair_category_display"
                                value="{{ old('repair_category_id', getRepairCategoryDetails($repairIssue->repair_category_id)) }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <p><b>Navigation:</b> {{ getFormattedRepairNavigation($repairIssue->repair_navigation) }}</p>
                        </div>
                        <button type="button" class="btn btn-secondary" id="change-category-btn">Change Category</button>
                    </div>
                </div>

                <!-- Category Edit Card: Multi-step category selector (initially hidden) -->
                <div class="card mb-3 d-none" id="category-edit-card">
                    <div class="card-header">Select New Category</div>
                    <div class="card-body">
                        <!-- Breadcrumb Navigation (optional) -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb"></ol>
                        </nav>
                        <!-- Category Main View -->
                        <div id="category-main-view" class="main-view">
                            <!-- Level 1 Categories: Rendered on page load -->
                            <div class="category-level" data-level="1">
                                <div class="row">
                                    @foreach ($categories as $category)
                                        @if(is_null($category->parent_id))
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input" type="radio" name="category_1"
                                                        id="repair-{{ $category->id }}" value="{{ $category->id }}">
                                                    <label class="form-check-label d-flex align-items-center"
                                                        for="repair-{{ $category->id }}">
                                                        <i class="fas fa-cogs me-2"></i>
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- Dynamically generated levels -->
                            @for ($level = 2; $level <= $maxLevel; $level++)
                                <div class="category-level" data-level="{{ $level }}" style="display: none;">
                                    <div class="row"></div>
                                </div>
                            @endfor
                        </div>
                        <!-- Hidden inputs to store new category navigation -->
                        <input type="hidden" name="repair_navigation" id="selected_categories">
                        <input type="hidden" name="repair_category_id" id="last_selected_category">
                        <!-- Navigation buttons for category selection -->
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" id="category-prev-btn">Previous</button>
                            <button type="button" class="btn btn-primary d-none " id="category-next-btn" disabled>Next</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">Description</div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                required>{{ old('description', $repairIssue->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header">Priority</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="priority">Select Priority</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="low" {{ $repairIssue->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $repairIssue->priority == 'medium' ? 'selected' : '' }}>Medium
                                </option>
                                <option value="high" {{ $repairIssue->priority == 'high' ? 'selected' : '' }}>High
                                </option>
                                <option value="critical" {{ $repairIssue->priority == 'critical' ? 'selected' : '' }}>
                                    Urgent</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-3 mb-3">
                    <div class="card-header">Status</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">Ticket Status</label>
                            <select name="status" id="status" class="form-control">
                                @foreach(['Pending', 'Reported', 'Under Process', 'Work Completed', 'Invoice Received', 'Invoice Paid', 'Closed'] as $status)
                                    <option value="{{ $status }}" {{ $repairIssue->status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <!-- New Fields: Tenant/Owner Availability and Access Details -->
                <div class="card mb-3">
                    <div class="card-header">Tenant/Owner Details</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tenant_availability">Preferred Availability for Repair (Tenant/Owner)</label>
                            <input type="datetime-local" name="tenant_availability" id="tenant_availability"
                                class="form-control"
                                value="{{ old('tenant_availability', optional($repairIssue->tenant_availability)->format('Y-m-d\TH:i')) }}">
                        </div>
                        <div class="form-group">
                            <label for="access_details">Access Details Note</label>
                            <!-- You might replace this with a rich text editor -->
                            <textarea name="access_details" id="access_details" class="form-control"
                                rows="3">{{ old('access_details', $repairIssue->access_details) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <!-- Estimated Price (Only for admin/property manager) -->
                {{-- @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('property_manager')) --}}
                <div class="card mb-3">
                    <div class="card-header">Estimated Price</div>
                    <div class="card-body">
                        <!-- Estimated Price Input -->
                        <div class="form-group">
                            <label for="estimated_price">Estimated Price</label>
                            <input type="number" step="0.01" name="estimated_price" id="estimated_price"
                                class="form-control"
                                value="{{ old('estimated_price', $repairIssue->estimated_price) }}">
                        </div>
                        <!-- VAT Type Radio Buttons -->
                        <div class="form-group mt-3">
                            <label>VAT Type:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vat_type" id="vat_type_inclusive"
                                    value="inclusive" {{ old('vat_type', $repairIssue->vat_type) == 'inclusive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="vat_type_inclusive">
                                    Inclusive VAT
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vat_type" id="vat_type_exclusive"
                                    value="exclusive" {{ old('vat_type', $repairIssue->vat_type) == 'exclusive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="vat_type_exclusive">
                                    Exclusive VAT
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}
            </div>
            <div class="col-6">
                <!-- Multiple Property Manager Assignment -->
                <div class="card mb-3">
                    <div class="card-header">Property Managers Assignment</div>
                    <div class="card-body">
                        <!-- Assume $propertyManagers is passed from controller as list of users with manager role -->
                        <div class="form-group">
                            <label for="property_managers">Assign Property Managers</label>
                            <select name="property_managers[]" id="property_managers" class="form-control select2"
                                multiple>
                                @foreach($propertyManagers as $manager)
                                    <option value="{{ $manager->id }}" {{ in_array($manager->id, $assignedManagers) ? 'selected' : '' }}>{{ $manager->full_name }} ({{ $manager->email }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <!-- Hidden template for new contractor assignment -->
                <div id="contractor-assignment-template" class="contractor-assignment mb-3 border p-3 d-none">
                    <!-- This element will hold the index label -->
                    <div class="assignment-index"></div>
                    <!-- Remove button -->
                    <button type="button" class="btn btn-danger btn-sm remove-contractor-assignment"
                        style="float: right;">Remove</button>
                    <input type="hidden" name="contractor_assignments[__index__][id]" value="">
                    <div class="form-group">
                        <label>Contractor</label>
                        <select name="contractor_assignments[__index__][contractor_id]" class="form-control">
                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}">{{ $contractor->full_name }} ({{ $contractor->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost_price___index__">Cost Price</label>
                        <input type="number" step="0.01" name="contractor_assignments[__index__][cost_price]"
                            id="cost_price___index__" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="quote_attachment___index__">Quote Price Document</label>
                        <input type="file" name="contractor_assignments[__index__][quote_attachment]"
                            id="quote_attachment___index__" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contractor_preferred_availability___index__">Preferred Availability
                            (Contractor)</label>
                        <input type="datetime-local"
                            name="contractor_assignments[__index__][contractor_preferred_availability]"
                            id="contractor_preferred_availability___index__" class="form-control">
                    </div>
                </div>

                <!-- Contractor Assignment Section wrapped in a card -->
                <div class="card mb-3">
                    <div class="card-header">Contractor Assignment</div>
                    <div class="card-body">
                        <div id="contractor-assignments">
                            <!-- Cloned contractor assignment blocks will appear here -->
                        </div>
                        <button type="button" id="add-contractor-assignment" class="btn btn-primary">Add
                            Contractor</button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">Tenant Details</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tenant-select">Select Tenant</label>
                            <select name="tenant_id" id="tenant-select" class="form-control">
                                <option value="">-- Select Tenant --</option>
                                <!-- Options will be populated dynamically via AJAX -->
                            </select>
                        </div>
                        <div id="tenant-preview" class="mt-3">
                            <!-- Tenant details preview will appear here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="float-end btn btn-primary">Update</button>
    </form>

    <a href="{{ route('admin.property_repairs.index') }}" class="float-start btn btn-secondary">Back to List</a>
</div>
@endsection
{{-- Include the partial to push Select2 assets into the stacks --}}
@include('backend.partials.assets.select2')
@section('page.scripts')
<script>
    $(document).ready(function () {
        // Global variables for category selection (for edit mode)
        let currentLevel = 1;
        let selectedCategories = {}; // Will hold new selection: e.g., { "level_1": "5", "level_2": "34" }
        let breadcrumbItems = [];
        let allCategories = {}; // This should be loaded from your categories API or embedded in the page

        // Preload all categories via AJAX (similar to create form)
        $.ajax({
            url: "{{ route('admin.get.repair.categories') }}",
            method: 'GET',
            async: false,
            success: function(data) {
                allCategories = data;
                console.log("All Categories Loaded:", allCategories);
            },
            error: function() {
                console.log("Error fetching categories.");
            }
        });

        // ----------------- PROPERTY SELECTION ----------------- //

        // Store the initial selected properties value to restore it in case of cancellation
        const initialSelectedProperties = JSON.parse($('#selected_properties').val());

        // Check if there are selected properties
        if (initialSelectedProperties && initialSelectedProperties.length > 0) {
            // Show the "Change Property" button and dynamic table with selected properties
            $('#change_property_button').show();
            $('#dynamic_property_table').removeClass('d-none');
            // searchPropertiesByIds(initialSelectedProperties);
        }

        // Show the search bar and hide the dynamic property table when "Change Property" button is clicked
        $(document).on('click','#change_property_button', function(e) {
            e.preventDefault();
            $('#dynamic_property_table').addClass('d-none'); // Hide the selected property table
            $('#search_property_section').show(); // Show the search input
            $('#cancel_property_change').show(); // Show the search input

            // Optionally reset the search field
            $('#search_property1').val('');

            // Hide the "Change Property" button after switching to search mode
            $(this).hide();

            // Clear the selected properties hidden field to allow new selection
            $('#selected_properties').val('[]');
        });

        // When the user cancels the property change, restore the previous ID and hide the search bar
        $(document).on('click', '#cancel_property_change', function(e) {
            e.preventDefault();
            // Restore the initial selected properties value
            $('#selected_properties').val(JSON.stringify(initialSelectedProperties));

            // Hide the search section and show the dynamic property table again
            $('#search_property_section').hide();
            $('#dynamic_property_table').removeClass('d-none');

            // Optionally, you can re-populate the dynamic property table
            searchPropertiesByIds(initialSelectedProperties);

            // Show the "Change Property" button again
            $('#change_property_button').show();
        });

        // Function to initialize the selected properties when at step 3
        function initSelectedProperties() {
            const selectedProperties_f = JSON.parse($('#selected_properties').val()); // Assuming selected properties are stored in a hidden field
            if (selectedProperties_f) {
                console.log('Selected Properties:', selectedProperties_f);
                searchPropertiesByIds(selectedProperties_f); // Call the function to fetch and display selected properties
            }
        }

        // Function to fetch property details by IDs
        function searchPropertiesByIds(propertyIds) {
            $.ajax({
                url: '{{ route('admin.contacts.properties.search') }}',
                method: 'GET',
                data: { ids: propertyIds },
                success: function(response) {
                    $('#dynamic_property_table tbody').empty();
                    response.forEach(function(property) {
                        if ($('#dynamic_property_table tbody tr[data-id="' + property.id + '"]').length === 0) {  // Prevent duplicates
                            var address = property.address || 'N/A';
                            var propRefNo = property.prop_ref_no || 'N/A';
                            var propName = property.prop_name || 'N/A';
                            var newRow = `<tr data-id="${property.id}">
                                            <td>${address} - ${propRefNo} - ${propName}</td>
                                            <td>${property.type}</td>
                                            <td>${property.availability}</td>
                                            <td><button class="btn btn-danger remove-btn">Remove</button></td>
                                        </tr>`;
                            $('#dynamic_property_table tbody').append(newRow);
                        }
                    });
                    updateSelectedProperties();
                    $('#dynamic_property_table').removeClass('d-none');
                },
                error: function() {
                    toastr.error('Error fetching properties by IDs.', 'Error');
                }
            });
        }

        initSelectedProperties();


        $(document).on('keyup keydown', '#search_property1', function () {
            var query = $(this).val().trim();
            if (query.length >= 3) {
                searchProperties(query);
                $('#error_message').hide();
            } else {
                $('#property_results').empty();
                $('#error_message').text('Please enter at least 3 characters to search.').show();
            }
        });

        function searchProperties(query) {
            $.ajax({
                url: '{{ route('properties.search') }}',
                method: 'GET',
                data: { query: query },
                success: function (response) {
                    $('#property_results').empty();
                    if (response.length > 0) {
                        response.forEach(function (property) {
                            if (!$('#property_results li[data-id="' + property.id + '"]').length) {
                                appendPropertyToResults(property);
                            }
                        });
                    } else {
                        $('#property_results').append('<li class="list-group-item">No properties found.</li>');
                    }
                },
                error: function () {
                    $('#property_results').append('<li class="list-group-item">Error fetching results.</li>');
                }
            });
        }

        function appendPropertyToResults(property) {
            var address = property.address || 'N/A';
            var propRefNo = property.prop_ref_no || 'N/A';
            var propName = property.prop_name || 'N/A';
            var listItem = `<li class="list-group-item property-result" data-id="${property.id}" data-type="${property.type}" data-availability="${property.availability}">
                                ${address} - ${propRefNo} - ${propName}
                            </li>`;
            $('#property_results').append(listItem);
        }

        $(document).on('click', '.property-result', function () {
            selectedProperty = $(this).data("id");
            $('#dynamic_property_table tbody').empty();
            $('#dynamic_property_table').removeClass('d-none');
            var propertyId = $(this).data('id');
            if ($('#dynamic_property_table tbody tr[data-id="' + propertyId + '"]').length === 0) {
                var newRow = `<tr data-id="${propertyId}">
                                <td>${$(this).text()}</td>
                                <td>${$(this).data('type')}</td>
                                <td>${$(this).data('availability')}</td>
                                <td><button class="btn btn-danger remove-btn">Remove</button></td>
                            </tr>`;
                $('#dynamic_property_table tbody').append(newRow);
                updateSelectedProperties();
            }
            $('#property_results').empty();
            $('#search_property1').val('');
        });

        function updateSelectedProperties() {
            var selectedPropertyIds = [];
            $('#dynamic_property_table tbody tr').each(function () {
                selectedPropertyIds.push($(this).data('id'));
            });
            $('#selected_properties').val(JSON.stringify(selectedPropertyIds));
        }

        $(document).on('click', '.remove-btn', function () {
            $(this).closest('tr').remove();
            updateSelectedProperties();
            if ($('#dynamic_property_table tbody tr').length < 1) {
                $('#dynamic_property_table').addClass('d-none');
                disableNextButton();
            }
        });

        // Fetch tenants for the given property.
        if (initialSelectedProperties) {
            $.ajax({
                url: "{{ route('admin.get.property_repairs.tenants') }}",
                method: "GET",
                data: { property_id: initialSelectedProperties },
                success: function(data) {
                    let options = '<option value="">-- Select Tenant --</option>';
                    $.each(data, function(i, tenant) {
                        // Add tenant details as data attributes.
                        options += `<option value="${tenant.id}"
                                    data-email="${tenant.email}"
                                    data-phone="${tenant.phone}"
                                    data-address="${tenant.address}">${tenant.full_name}</option>`;
                    });
                    $('#tenant-select').html(options);
                },
                error: function() {
                    console.log("Error fetching tenants.");
                }
            });
        }

        // When a tenant is selected, update the preview area.
        $('#tenant-select').on('change', function() {
            let selected = $(this).find('option:selected');
            if (selected.val() === "") {
                $('#tenant-preview').html('');
                return;
            }
            let details = `
                <p><strong>Name:</strong> ${selected.text()}</p>
                <p><strong>Email:</strong> ${selected.data('email') || 'N/A'}</p>
                <p><strong>Phone:</strong> ${selected.data('phone') || 'N/A'}</p>
            `;
            $('#tenant-preview').html(details);
        });
        // ---- Prepopulate Preselected Category Values ---- //
        // Assume $repairIssue->repair_navigation is stored as JSON (e.g., {"level_1":"5","level_2":"34"})
        let preselected = {!! json_encode($repairIssue->repair_navigation) !!};
        console.log("Preselected Categories:", preselected);
        if (typeof preselected === 'object' && preselected !== null) {
            selectedCategories = preselected;
            // Set currentLevel to the deepest level found:
            let levels = Object.keys(selectedCategories).map(k => parseInt(k.replace('level_', '')));
            currentLevel = levels.length ? Math.max(...levels) : 1;
        }

        $.each(selectedCategories, function(key, value) {
            // Remove "level_" from the key to get the numeric level value.
            let levelNumber = key.replace('level_', '');
            // Select the radio button in the container with data-level equal to levelNumber and value equal to value.
            let $radio = $(`.category-level[data-level="${levelNumber}"] input[type="radio"][value="${value}"]`);
            console.log("Processing:", key, "->", value);
            console.log("Selector result length:", $radio.length);
            if ($radio.length) {
                $radio.prop('checked', true);
            } else {
                console.warn("No radio button found for level", levelNumber, "with value", value);
            }
        });


    // Updated hidden inputs updater
    function updateHiddenInputs() {
        $('#selected_categories').val(JSON.stringify(selectedCategories));
        let deepest = Object.keys(selectedCategories).length;
        if (deepest === currentLevel) {
            $('#last_selected_category').val(selectedCategories[`level_${currentLevel}`] || '');
        } else {
            $('#last_selected_category').val('');
        }
    }

    // Call updateHiddenInputs() after every change:
    updateHiddenInputs();

        // Initialize breadcrumb (you can prepopulate breadcrumb if needed)
        function updateBreadcrumbUI(){
            let html = '';
            breadcrumbItems.forEach((item, index) => {
                if (index < breadcrumbItems.length - 1) {
                    html += `<li class="breadcrumb-item clickable" data-index="${index}" style="cursor:pointer;">${item}</li>`;
                } else {
                    html += `<li class="breadcrumb-item active" aria-current="page" data-index="${index}">${item}</li>`;
                }
            });
            $('ol.breadcrumb').html(html);
        }
        function resetBreadcrumb() {
            breadcrumbItems = ['Select Category'];
            updateBreadcrumbUI();
        }
        resetBreadcrumb();

        // Category selection navigation buttons (Next and Previous)
        $(document).on('click', '#category-next-btn', function(){
            // Process current selection in the visible level
            let visibleLevel = $(`.category-level[data-level="${currentLevel}"]`);
            let selectedRadio = visibleLevel.find('input[type="radio"]:checked');
            if (!selectedRadio.length) return;
            let selectedValue = selectedRadio.val();
            let selectedName = selectedRadio.siblings('label').text().trim();
            selectedCategories[`level_${currentLevel}`] = selectedValue;
            // Update breadcrumb for this level:
            breadcrumbItems = breadcrumbItems.slice(0, currentLevel);
            breadcrumbItems.push(selectedName);
            updateBreadcrumbUI();

            // Check for children categories using our preloaded allCategories:
            let children = allCategories[selectedValue] || [];
            if (children.length > 0) {
                let nextLevel = currentLevel + 1;
                let nextLevelContainer = $(`[data-level="${nextLevel}"]`);
                let html = '';
                children.forEach(function(category) {
                    html += `
                        <div class="col-md-4 mb-2">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="category_${nextLevel}" id="category-${category.id}" value="${category.id}">
                                <label class="form-check-label d-flex align-items-center" for="category-${category.id}">
                                    <i class="fas fa-cogs me-2"></i> ${category.name}
                                </label>
                            </div>
                        </div>
                    `;
                });
                nextLevelContainer.find('.row').html(html);
                visibleLevel.hide();
                nextLevelContainer.show();
                currentLevel++;
                disableCategoryNextBtn();
            } else {
                // No further children: final selection is made
                // Hide the category edit card and update hidden fields
                updateHiddenInputs();
                // Optionally, you can automatically hide the edit interface
                // and update the display card.
            }
            updateHiddenInputs();
        });
        $(document).on('click', '#category-prev-btn', function(){
            if (currentLevel > 1) {
                $(`[data-level="${currentLevel}"]`).hide().find('.row').empty();
                delete selectedCategories[`level_${currentLevel}`];
                currentLevel--;
                $(`[data-level="${currentLevel}"]`).show();
                breadcrumbItems.pop();
                updateBreadcrumbUI();
                enableCategoryNextBtn();
            } else {
                // At level 1: cancel category change.
                // Optionally, hide the category edit card and show the display card.
                $('#category-edit-card').addClass('d-none');
                $('#category-display-card').removeClass('d-none');
            }
            updateHiddenInputs();
        });

        $(document).on('change', '.category-level input[type="radio"]', function(){
            let level = $(this).closest('.category-level').data('level');
            let selectedValue = $(this).val();
            // Update the selectedCategories for the current level
            selectedCategories[`level_${level}`] = selectedValue;
            updateHiddenInputs();
            // Check if this selection has children in allCategories
            let children = allCategories[selectedValue] || [];
            if(children.length > 0){
                // Automatically trigger the next button click if not already in the next level.
                if (currentLevel === level) {
                    // console.log('Triggering next button click...');
                    enableCategoryNextBtn();
                    $('#category-next-btn').click();
                    disableCategoryNextBtn();
                    // console.log('Next button clicked.');
                }
            } else {
                // No children; just update hidden inputs and breadcrumb.
                // Optionally, you might want to disable the next button if no further children exist.
                disableCategoryNextBtn();
                updateHiddenInputs();
            }
        });

        function disableCategoryNextBtn() {
            $('#category-next-btn').prop('disabled', true);
        }
        function enableCategoryNextBtn() {
            $('#category-next-btn').prop('disabled', false);
        }
        // Enable the next button if a radio button is selected in the current level.
        $(document).on('change', '.category-level input[type="radio"]', function(){
            // enableCategoryNextBtn();
            updateHiddenInputs();
        });

        // Toggle between read-only display and editable category selection.
        $('#change-category-btn').on('click', function () {
            // Hide the display card and show the edit card.
            $('#category-display-card').addClass('d-none');
            $('#category-edit-card').removeClass('d-none');
        });

        $('ol.breadcrumb').on('click', 'li.clickable', function () {
            let index = $(this).data('index');
            if (index === 0) {
                // Go back to step 1 (or reset to the first category level)
                currentLevel = 1;
                breadcrumbItems = breadcrumbItems.slice(0, 1);
                updateBreadcrumbUI();
                $(".category-level").hide();
                $(`[data-level="1"]`).show();
            } else {
                // Go back to the clicked level
                // Remove selections beyond the clicked level
                for (let lvl = index + 1; lvl <= currentLevel; lvl++) {
                    delete selectedCategories[`level_${lvl}`];
                }
                currentLevel = index;
                breadcrumbItems = breadcrumbItems.slice(0, index + 1);
                updateBreadcrumbUI();
                $(".category-level").hide();
                $(`[data-level="${currentLevel}"]`).show();
            }
            updateHiddenInputs();
        });
    });

    initSelect2('.select2');

    $(document).ready(function () {

        // Function to update the index display on each contractor assignment block.
        function updateContractorIndexes() {
            $('#contractor-assignments .contractor-assignment').each(function (index) {
                let $assignment = $(this);
                // Prepend a badge showing the index number (starting at 1)
                $assignment.find('.assignment-index').remove();
                $assignment.prepend(`<div class="assignment-index badge bg-secondary mb-2">#${index + 1}</div>`);
            });

            // If only one assignment exists, hide its remove button.
            if ($('#contractor-assignments .contractor-assignment').length === 1) {
                $('#contractor-assignments .contractor-assignment .remove-contractor-assignment').hide();
            } else {
                $('#contractor-assignments .contractor-assignment .remove-contractor-assignment').show();
            }
        }

        // Function to add a contractor assignment block
        function addContractorAssignment(index) {
            // Clone the hidden template
            let $template = $('#contractor-assignment-template').clone();
            // Remove the id to avoid duplicate IDs and show the block
            $template.removeAttr('id').removeClass('d-none');
            // Replace all occurrences of __index__ with the actual index value
            let html = $template.html().replace(/__index__/g, index);
            $template.html(html);
            // Append the cloned element to the container
            $('#contractor-assignments').append($template);
            // Update the indexes on all assignments
            updateContractorIndexes();
        }

        // On page load, add the default contractor assignment block if none exists.
        if ($('#contractor-assignments .contractor-assignment').length === 0) {
            addContractorAssignment(0);
        }

        // When the "Add Contractor" button is clicked, add a new assignment.
        $('#add-contractor-assignment').on('click', function () {
            let index = $('#contractor-assignments .contractor-assignment').length;
            addContractorAssignment(index);
        });

        // Delegate event handler for the "Remove" button on each cloned assignment block.
        $(document).on('click', '.remove-contractor-assignment', function () {
            $(this).closest('.contractor-assignment').remove();
            updateContractorIndexes();
        });
    });
</script>
@endsection
