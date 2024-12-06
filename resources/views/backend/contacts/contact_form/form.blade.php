<!-- resources/views/backend/contact/contact_form/form.blade.php -->
@php
$stepNames = [
    1 => 'Category',
    2 => 'Personal Information',
    3 => 'Related Properties',
];

    // Determine the last enabled step based on $contact->step or default to 1
    $currentStep = isset($contact->quick_step) ? $contact->quick_step+1 : 1;
@endphp


    <h4 class="mb-4">Quick Add Contact</h4>
    <div class="qap_breadcrumb">
            @for ($i = 1; $i <= count($stepNames); $i++)
                <div class="form-check {{ $currentStep == $i ? 'active' : '' }}">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="step"
                        id="step{{ $i }}"
                        value="{{ $i }}"
                        {{ $currentStep == $i || ($i == 1 && !$contact) ? 'checked' : '' }}
                        {{ $i <= $currentStep ? '' : 'disabled' }}>

                    <label class="form-check-label {{ $currentStep == $i ? 'active' : '' }}" for="step{{ $i }}">{{ $stepNames[$i] ?? 'Unknown Step'}}</label>
                </div>
            @endfor
    </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 render_blade">
            @include('backend.contacts.contact_form.step' . $currentStep )
        </div>
    </div>
</div>


@section('page.scripts')
<script>
$(document).ready(function() {
    // General function to handle sending form data and navigating steps
    function handleStepChange(currentStep, targetStep, previous = null) {
        // Check if navigating to a previous step
        if (previous) {
            // Render the previous step and update the radio button selection
            renderStep(targetStep);
            $('input[name="step"][value="' + targetStep + '"]').prop('checked', true);
            return; // Exit early as no validation or data submission is needed for previous steps
        }

        // Validate the current step form only when moving forward
        const isValid = initValidate('#contact-form-step-' + currentStep);

        // If validation passed, proceed to send data and update to the next step
        if (isValid) {
            // Send form data for current step before navigating to the target step
            sendFormData(currentStep);
            // Update the radio button selection to the target step
            $('input[name="step"][value="' + targetStep + '"]').prop('checked', true);
            // Enable the next step in the navigation
            $('input[name="step"][value="' + targetStep + '"]').prop('disabled', false);
        }
    }


    // Function to send form data for a specific step
    function sendFormData(step) {
        const formData = new FormData($('#contact-form-step-' + step)[0]);
        formData.append('step', step);
        // Add contact_id to the form data if it doesn't already exist
        const contactId = $('#contact_id').val(); // Get the contact_id from the hidden input
        let contactIdExists = false;

        // Check if contact_id already exists in the formData
        for (let [key, value] of formData.entries()) {
            if (key === 'contact_id') {
                contactIdExists = true;
                break;
            }
        }

        // Append contact_id only if it doesn't exist already
        if (contactId && !contactIdExists) {
            formData.append('contact_id', contactId);
        }
        $.ajax({
            url: '{{ route("admin.contacts.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.render_blade').html(response);
            },
            error: function(jqXHR) {
                if (jqXHR.status === 422) {
                    const errors = jqXHR.responseJSON.errors;
                    Object.keys(errors).forEach(key => {
                        toastr.error(errors[key][0], 'Validation Error');
                    });
                }
            }
        });
    }

    @php
    $formStepRenderUrl = isset($contact) ?
        route('admin.contacts.contact_step', ['step' => ':step', 'contact_id' => $contact->id]) :
        route('admin.contacts.contact_step', ['step' => ':step']);
    @endphp

    // Function to render the view for a specific step
    function renderStep(step) {
        // Get contact_id from the hidden input field if available
        const contactId = $('#contact_id').val();
        // Replace ':step' with the actual step in the URL
        let formStepRenderUrl = '{{ $formStepRenderUrl }}'.replace(':step', step);

        // Check if 'contact_id' is already present in the URL
        if (contactId && !formStepRenderUrl.includes('contact_id')) {
            formStepRenderUrl += `?contact_id=${contactId}`;
        }

        $.ajax({
            url: formStepRenderUrl,
            method: 'GET',
            success: function(response) {
                $('.render_blade').html(response);

                // Find id="contact_id" and put the contactId if it’s missing
                if (!$('#contact_id').val()) {
                    $('#contact_id').val(contactId);
                }
            },
            error: function() {
                toastr.error('Unable to load step. Please try again.', 'Error');
            }
        });
    }

    // Handle Next button clicks
    $(document).on('click', '.next-step', function(e) {
        e.preventDefault();
        const currentStep = $(this).data('current-step');
        const targetStep = $(this).data('next-step');

        handleStepChange(currentStep, targetStep);
    });

    // Handle Previous button clicks
    $(document).on('click', '.previous-step', function(e) {
        e.preventDefault();
        const currentStep = $(this).data('current-step');
        const targetStep = $(this).data('previous-step');
        const previous = true;

        handleStepChange(currentStep, targetStep, previous);
    });

    // Handle radio button change
    $('input[name="step"]').change(function() {
        const selectedStep = $(this).val();
        renderStep(selectedStep); // Render the corresponding Blade view
    });

});
$(document).ready(function() {
    // Function to handle property search
    function searchProperties(query) {
        // Perform the AJAX request to search properties
        $.ajax({
            url: '{{ route('admin.contacts.properties.search') }}',  // Define the route for search
            method: 'GET',
            data: { query: query },
            success: function(response) {
                // Clear previous search results
                $('#property_results').empty();

                // Check if there are any results
                if (response.length > 0) {
                    response.forEach(function(property) {
                        // Create a list item for each result
                        var listItem = '<li class="list-group-item property-result" data-id="' + property.id + '">' +
                                           property.prop_ref_no + ' - ' + property.prop_name + ' (' + property.city + ') ' + '</li>';
                        $('#property_results').append(listItem);
                    });
                } else {
                    $('#property_results').append('<li class="list-group-item">No properties found.</li>');
                }
            },
            error: function() {
                $('#property_results').append('<li class="list-group-item">Error fetching results.</li>');
            }
        });
    }

    $(document).on('keyup keydown', '#search_property1', function() {
        var query = $(this).val().trim();  // Get the search query

        if (query.length >= 3) {  // Trigger search when 3 or more characters are entered
            searchProperties(query);
            $('#error_message').hide(); // Hide the error message if the query length is valid
        } else {
            $('#property_results').empty(); // Clear the results if query length is less than 3 characters

            // Show an error message telling the user to write at least 3 letters
            $('#error_message').text('Please enter at least 3 characters to search.').show();
        }
    });


    // Handle property selection
    $(document).on('click', '.property-result', function() {
        var propertyId = $(this).data('id');  // Get selected property ID

        // Check if the property is already selected
        if ($('#selected_properties').find('.selected-property[data-id="' + propertyId + '"]').length === 0) {
            // Create an element to show the selected property
            var selectedPropertyItem = '<div class="selected-property" data-id="' + propertyId + '">' +
                                           '<span>' + $(this).text() + '</span>' +
                                           '<button type="button" class="btn btn-warning btn-sm remove-property" data-id="' + propertyId + '">Remove</button>' +
                                         '</div>';
            // Append the selected property to the selected list
            $('#selected_properties').append(selectedPropertyItem);
        }

        // Clear search results
        $('#property_results').empty();
        $('#search_property1').val(''); // Optionally clear the search input field
    });

    // Handle property removal from the selected list
    $(document).on('click', '.remove-property', function() {
        var propertyId = $(this).data('id'); // Get the property ID to be removed

        // Remove the property from the selected list
        $('#selected_properties').find('.selected-property[data-id="' + propertyId + '"]').remove();
    });
});


</script>
@endsection
