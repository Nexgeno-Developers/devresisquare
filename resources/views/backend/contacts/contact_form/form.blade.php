<!-- resources/views/backend/contact/contact_form/form.blade.php -->
@php
$stepNames = [
1 => 'Category',
2 => 'Personal Information',
3 => 'Emergency Contact',
4 => 'Bank Details',
5 => 'Related Properties',
];

    // Determine the last enabled step based on $property->step or default to 1
    $currentStep = isset($property->contact_step) ? $property->contact_step+1 : 1;
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
                        {{ $currentStep == $i || ($i == 1 && !$property) ? 'checked' : '' }}
                        {{ $i <= $currentStep ? '' : 'disabled' }}>

                    <label class="form-check-label {{ $currentStep == $i ? 'active' : '' }}" for="step{{ $i }}">{{ $stepNames[$i] ?? 'Unknown Step'}}</label>
                </div>
            @endfor
    </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 render_blade">
            @include('backend.contacts.contact_form.step' . session('current_step', 1))
            <!-- Default to step 1 -->
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
        const isValid = initValidate('#property-form-step-' + currentStep);

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
        const formData = new FormData($('#property-form-step-' + step)[0]);
        formData.append('step', step);
        // Add property_id to the form data if it doesn't already exist
        const propertyId = $('#property_id').val(); // Get the property_id from the hidden input
        let propertyIdExists = false;

        // Check if property_id already exists in the formData
        for (let [key, value] of formData.entries()) {
            if (key === 'property_id') {
                propertyIdExists = true;
                break;
            }
        }

        // Append property_id only if it doesn't exist already
        if (propertyId && !propertyIdExists) {
            formData.append('property_id', propertyId);
        }
        $.ajax({
            url: '{{ route("admin.contacts.contact_store") }}',
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

    // Function to render the view for a specific step
    // function renderStep(step) {
    //     const formStepRenderUrl = '{{-- route("admin.properties.contact_step", ":step") --}}'.replace(':step', step);
    // Define the URL based on the condition if $property exists
    @php
    $formStepRenderUrl = isset($property) ?
        route('admin.contacts.contact_step', ['step' => ':step', 'property_id' => $property->id]) :
        route('admin.contacts.contact_step', ['step' => ':step']);
    @endphp
    // Function to render the view for a specific step
    function renderStep(step) {
        // Get property_id from the hidden input field if available
        const propertyId = $('#property_id').val();
        // Replace ':step' with the actual step in the URL
        let formStepRenderUrl = '{{ $formStepRenderUrl }}'.replace(':step', step);

        // Check if 'property_id' is already present in the URL
        if (propertyId && !formStepRenderUrl.includes('property_id')) {
            formStepRenderUrl += `?property_id=${propertyId}`;
        }

        $.ajax({
            url: formStepRenderUrl,
            method: 'GET',
            success: function(response) {
                $('.render_blade').html(response);

                // Find id="property_id" and put the propertyId if it’s missing
                if (!$('#property_id').val()) {
                    $('#property_id').val(propertyId);
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

    // Handle Next and Previous button clicks
    $(document).on('click', '.propertyType', function(e) {
        e.preventDefault();
        const currentStep3 = $('.next-step').data('current-step');
        const targetStep4 = $('.next-step').data('next-step');

        handleStepChange(currentStep3, targetStep4);
    });
    // // Function to check if both Bedrooms and Reception Rooms have been selected
    // function checkSelectionsAndSubmit() {
    //     const bedroomSelected = $('input[name="bedroom"]:checked').val();
    //     const receptionSelected = $('input[name="reception"]:checked').val();

    //     // If both Bedrooms and Reception Rooms are selected, submit the form
    //     if (bedroomSelected && receptionSelected) {
    //         const currentStep3 = $('.next-step').data('current-step');
    //         const targetStep4 = $('.next-step').data('next-step');

    //         handleStepChange(currentStep3, targetStep4);
    //     }
    // }

    // // Event listeners for Bedrooms and Reception Rooms radio buttons, class-based with delegation
    // $(document).on('click', '.bedroom-radio', checkSelectionsAndSubmit);
    // $(document).on('click', '.reception-radio', checkSelectionsAndSubmit);

    // Function to check if both Bedrooms and Reception Rooms have been selected

/* Quick Step 3 */
    // Handle Next and Previous button clicks
    $(document).on('click', '.bedroom-radio', function(e) {
        e.preventDefault();
        const currentStep5 = $('.next-step').data('current-step');
        const targetStep6 = $('.next-step').data('next-step');

        handleStepChange(currentStep5, targetStep6);
    });
/* Quick Step 4 */
    // Handle Next and Previous button clicks
    $(document).on('click', '.bathroom-radio', function(e) {
        e.preventDefault();
        const currentStep7 = $('.next-step').data('current-step');
        const targetStep8 = $('.next-step').data('next-step');

        handleStepChange(currentStep7, targetStep8);
    });
    /* Quick Step 5 */
    // Handle Next and Previous button clicks
    $(document).on('click', '.reception-radio', function(e) {
        e.preventDefault();
        const currentStep9 = $('.next-step').data('current-step');
        const targetStep10 = $('.next-step').data('next-step');

        handleStepChange(currentStep9, targetStep10);
    });
    /* Quick Step 6 */
    $(document).on('click', '.furnish-radio', function(e) {
        e.preventDefault();
        const currentStep11 = $('.next-step').data('current-step');
        const targetStep12 = $('.next-step').data('next-step');

        handleStepChange(currentStep11, targetStep12);
    });
/* Quick Step 7 */
    function checkSelectionsAndSubmit() {
        const parkingSelected = $('input[name="parking"]:checked').val();
        const gardenSelected = $('input[name="garden"]:checked').val();
        const balconySelected = $('input[name="balcony"]:checked').val();

        // If both parkings and balcony Rooms are selected, submit the form
        if (parkingSelected && gardenSelected && balconySelected) {
            const currentStep13 = $('.next-step').data('current-step');
            const targetStep14 = $('.next-step').data('next-step');

            handleStepChange(currentStep13, targetStep14);
        }
    }
    $(document).on('click', '.parking-radio', checkSelectionsAndSubmit);
    $(document).on('click', '.garden-radio', checkSelectionsAndSubmit);
    $(document).on('click', '.balcony-radio', checkSelectionsAndSubmit);

    /* Quick Step 8 */
    function checkStep8AndSubmit() {
        const priceSelected = $('input[name="price"]').val();
        const managementSelected = $('input[name="management"]:checked').val();

        // If both parkings and balcony Rooms are selected, submit the form
        if (priceSelected  && managementSelected ) {
            const currentStep13 = $('.next-step').data('current-step');
            const targetStep14 = $('.next-step').data('next-step');

            handleStepChange(currentStep13, targetStep14);
        }
    }
    $(document).on('click', '.prince_input', checkStep8AndSubmit);
    $(document).on('click', '.management-radio', checkStep8AndSubmit);

});
</script>
@endsection
