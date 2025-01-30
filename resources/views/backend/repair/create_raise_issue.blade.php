@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Report a Repair</h1>

    <form id="repair-form-page">

    <div class="steps_wrapper">

        <div class="report-repair">
            <div class="row">
                <h2>Where is the problem?</h2>
                <div class="col-md-6">
                    <div class="from-group mt-lg-0 mt-4">
                        <label class="mb-2" for="search_property1">Search And Select Property</label>
                        <div class="row">
                            <div class="col-12">

                                <!-- Search input field for properties -->
                                <div class="form-group">
                                    <div class="rs_input input_search">
                                        <div class="right_icon d-flex align-items-center"><i class="bi bi-search"></i></div>
                                        <input type="text" id="search_property1" placeholder="Search Property" class="form-control search_property"/>
                                    </div>
                                    <div id="error_message" style="color: red; display: none;"></div>
                                </div>

                                <!-- Search results listing -->
                                <ul id="property_results" class="list-group mt-2"></ul>

                                <!-- Selected Properties -->
                                <input type="hidden" id="selected_properties" name="selected_properties"
                                    value="{{ json_encode(isset($selectedProperties) ? $selectedProperties : []) }}">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dynamic Property Table -->
                <div id="dynamic_property_table" class="d-none mt-4">
                    @php
                        $headers = ['id' => 'id', 'Address', 'Type', 'Availability'];
                        $rows = []; // Start with an empty array of rows
                    @endphp
                    <x-backend.dynamic-table :headers="$headers" :rows="$rows" class='contact_add_property' />
                </div>
            </div>
            <div class="report-repair-problem">
                <h3>What is the problem?</h2>
                <p>Do not worry please report a problem for property manager to review and take appropriate action.</p>

                <x-search-dropdown name="select_repair_category" route="{{ route('admin.get.repair.categories') }}" placeholder="Search repair category..." />
            </div>
        </div>



        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Raise Repair Issue</li>
                    <!-- Breadcrumb items will be added dynamically -->
                </ol>
            </nav>

            <!-- Navigation Buttons -->
            <div class="d-flex">
                <button id="prev-btn" class="btn btn-secondary d-none">Previous</button>
                <button id="next-btn" class="btn btn-primary" disabled>Next</button>
            </div>
        </div>

        <h3>Select a Category</h3>

        <div class="main-view">
            <!-- Default Level 1 (Parent Categories) -->
            <div class="category-level" data-level="1">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-4">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="repair_category"
                                    id="repair-{{ $category->id }}" value="{{ $category->id }}">
                                <label class="form-check-label d-flex align-items-center" for="repair-{{ $category->id }}">
                                    <i class="fas fa-cogs me-2"></i> <!-- Font Awesome icon -->
                                    {{ $category->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dynamically Generated Levels -->
            @for ($level = 2; $level <= $maxLevel; $level++)
                <div class="category-level" data-level="{{ $level }}" style="display: none;">
                    <!-- Placeholder for level {{ $level }} -->
                    <div class="row"></div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Include Common Form on the Last Step -->
    <div id="repair-form" class="d-none">
        @include('backend.repair.common_form')
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    @endsection

    @section('page.scripts')

        @stack('domready.scripts')
    <script>
        $(document).ready(function () {

            function logSearchValue() {
                const searchValue = document.getElementById('searchInput').value;
                console.log("Search Value:", searchValue);
            }

            let currentLevel = 1;
            let selectedCategories = {}; // Store selected category IDs by level

            // Update Breadcrumb
            function updateBreadcrumb(name) {
                const breadcrumb = $('ol.breadcrumb');
                breadcrumb.find('li').removeClass('active').last().addClass('active');
                breadcrumb.append(
                    `<li class="breadcrumb-item active" aria-current="page">${name}</li>`
                );
            }

            function checkLastStep(selectedCategories) {
                $.ajax({
                    url: "{{ route('admin.repair.checkLastStep') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        selectedCategories: selectedCategories
                    },
                    success: function (response) {
                        if (response.isLastStep) {
                            // Hide the next button and show the form if it's the last step
                            $('#next-btn').prop('disabled', true);
                            // $('#prev-btn').addClass('d-none');
                            // $('#next-btn').addClass('d-none');
                            $('#repair-form').removeClass('d-none'); // Show the form
                        }
                    },
                    error: function (error) {
                        AIZ.plugins.notify('error', 'An error occurred while checking the last step.');
                    }
                });
            }

            $(document).on('change', 'input[type="radio"]', function () {
                const selectedRadioValue = $(this).val();
                const selectedNameRadio = $(this).siblings('label').text().trim();
                console.log("Selected Value:", selectedRadioValue);
                console.log("Selected Name:", selectedNameRadio);
                // Add to breadcrumb
                // updateBreadcrumb(selectedNameRadio);

                $('#next-btn').prop('disabled', false);
                // Check if the repair form is visible
                if (!$('#repair-form').hasClass('d-none')) {
                    $('#repair-form').addClass('d-none'); // Hide the form
                }

                // Optional: Clear breadcrumb or other UI elements tied to the form
            });

            // $('input[name="parent_category"]').on('change', function () {
            //     const selectedRadioValue = $(this).val();
            //     console.log("Selected Value:", selectedRadioValue);

            //     if (!$('#repair-form').hasClass('d-none')) {
            //         $('#repair-form').addClass('d-none'); // Hide the form
            //     }
            // });

            // Handle Next Button Click
            $('#next-btn').on('click', function () {
                const visibleLevel = $(`.category-level[data-level="${currentLevel}"]`);
                const selectedRadio = visibleLevel.find('input[type="radio"]:checked');

                if (!selectedRadio.length) return; // No category selected

                const selectedValue = selectedRadio.val();
                const selectedName = selectedRadio.siblings('label').text().trim();

                // Store the selected category for the current level
                selectedCategories[currentLevel] = selectedValue;
                console.log('Selected Categories:', selectedCategories);

                // Fetch Subcategories for the Next Level
                $.ajax({
                    url: "{{ route('admin.property_repairs.getSubCategories', ['categoryId' => '__categoryId__']) }}"
                        .replace('__categoryId__', selectedValue),
                    method: 'GET',
                    success: function (data) {
                        if (data.length) {
                            const nextLevelContainer = $(`[data-level="${currentLevel + 1}"]`);
                            let html = '';
                            data.forEach((category) => {
                                html += `
                                    <div class="col-md-4">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="category_${currentLevel + 1}" id="category-${category.id}" value="${category.id}">
                                            <label class="form-check-label d-flex align-items-center" for="category-${category.id}">
                                                <i class="fas fa-cogs me-2"></i> ${category.name}
                                            </label>
                                        </div>
                                    </div>
                                `;
                            });

                            nextLevelContainer.find('.row').html(html);
                            $('.category-level').hide(); // Hide all levels
                            nextLevelContainer.show(); // Show next level
                            currentLevel++;
                            $('#prev-btn').removeClass('d-none'); // Show Previous button
                            $('#next-btn').prop('disabled', true); // Disable Next button
                            // Add to breadcrumb
                            updateBreadcrumb(selectedName);
                        } else {
                            // Call checkLastStep to determine if it's the last step
                            checkLastStep(selectedCategories); // Call the function here
                        }


                    },
                    error: function (error) {
                        // Call checkLastStep to determine if it's the last step
                        checkLastStep(selectedCategories); // Call the function here
                        // if (error.responseJSON && error.responseJSON.message) {
                        //     AIZ.plugins.notify('error', error.responseJSON.message); // Show error message using AIZ notification
                        // } else {
                        //     AIZ.plugins.notify('error', 'An unknown error occurred while fetching subcategories.'); // Default error message
                        // }
                    }
                });
            });

            // Handle Previous Button Click
            $('#prev-btn').on('click', function () {
                if (currentLevel > 1) {
                    // Remove the current level's selected category
                    delete selectedCategories[currentLevel];
                    console.log('Selected Categories:', selectedCategories);
                    $(`[data-level="${currentLevel}"]`).hide().find('.row')
                        .empty(); // Hide and clear current level
                    currentLevel--;
                    $(`[data-level="${currentLevel}"]`).show(); // Show previous level
                    $('ol.breadcrumb li').last().remove(); // Remove last breadcrumb

                    if (currentLevel === 1) {
                        $('#prev-btn').addClass('d-none'); // Hide Previous button if on first level
                    }
                    $('#next-btn').prop('disabled', false); // Enable Next button
                }

                if (!$('#repair-form').hasClass('d-none')) {
                    $('#repair-form').addClass('d-none'); // Hide the form
                }


            });


            // property search


            // Handle the search input events (keyup and keydown)
            $(document).on('keyup keydown', '#search_property1', function () {
                var query = $(this).val().trim();  // Get the search query

                if (query.length >= 3) {  // Trigger search when 3 or more characters are entered
                    searchProperties(query);
                    $('#error_message').hide(); // Hide the error message if the query length is valid
                } else {
                    $('#property_results').empty(); // Clear the results if query length is less than 3 characters
                    $('#error_message').text('Please enter at least 3 characters to search.').show(); // Show the error message
                }
            });

            // Function to perform the AJAX request for searching properties
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

            // Function to add a property to the results list
            function appendPropertyToResults(property) {
                var address = property.address || 'N/A';
                var propRefNo = property.prop_ref_no || 'N/A';
                var propName = property.prop_name || 'N/A';
                var listItem = `<li class="list-group-item property-result" data-id="${property.id}" data-type="${property.type}" data-price="${property.price}" data-availability="${property.availability}">
                            ${address} - ${propRefNo} - ${propName}
                        </li>`;
                $('#property_results').append(listItem);
            }

            // Handle property selection and append it to the dynamic table
            $(document).on('click', '.property-result', function () {
                $('#dynamic_property_table').removeClass('d-none');
                var propertyId = $(this).data('id');
                if ($('#dynamic_property_table tbody tr[data-id="' + propertyId + '"]').length === 0) {  // Prevent duplicates
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

            // Update the hidden input with the current list of selected property IDs
            function updateSelectedProperties() {
                var selectedPropertyIds = [];
                $('#dynamic_property_table tbody tr').each(function () {
                    selectedPropertyIds.push($(this).data('id'));
                });
                $('#selected_properties').val(JSON.stringify(selectedPropertyIds));
            }

            // Remove function - Remove the row when the "Remove" button is clicked
            $(document).on('click', '.remove-btn', function () {
                $(this).closest('tr').remove();
                updateSelectedProperties();

                // Check if there are no rows left in the table
                if ($('#dynamic_property_table tbody tr').length < 1) {
                    $('#dynamic_property_table').addClass('d-none');
                }
            });

            // Function to initialize the selected properties when at step 3
            function initSelectedProperties() {
                const selectedProperties_f = JSON.parse($('#selected_properties').val()); // Assuming selected properties are stored in a hidden field
                if (selectedProperties_f && selectedProperties_f.length > 0) {
                    searchPropertiesByIds(selectedProperties_f); // Call the function to fetch and display selected properties
                }
            }

            // Get and display the pre-selected properties when the page loads
            const selectedProperties = JSON.parse($('#selected_properties').val());
            if (selectedProperties && selectedProperties.length > 0) {
                searchPropertiesByIds(selectedProperties);
            }

            // Function to fetch property details by IDs
            function searchPropertiesByIds(propertyIds) {
                $.ajax({
                    url: '{{ route('properties.search') }}',
                    method: 'GET',
                    data: { ids: propertyIds },
                    success: function (response) {
                        $('#dynamic_property_table tbody').empty();
                        response.forEach(function (property) {
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
                    },
                    error: function () {
                        toastr.error('Error fetching properties by IDs.', 'Error');
                    }
                });
            }


        });
    </script>
    @endsection
