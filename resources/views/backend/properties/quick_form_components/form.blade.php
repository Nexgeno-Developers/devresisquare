<!-- resources/views/backend/properties/form_components/form.blade.php -->
@php
    function getBreadcrumb($step)
    {
        $breadcrumb = [
            1 => 'Property Address',
            2 => 'Property Type',
            3 => 'Rooms',
            4 => 'Price',
            /*1 => 'Property name',
            2 => 'Property Address',
            3 => 'Property Type',
            4 => 'Rooms',
            5 => 'Price',*/
        ];

        return $breadcrumb[$step] ?? 'Unknown Step';
    }
@endphp

<div class="">
    <h4 class="mb-4">Quick Add Property</h4>
    <div class="qap_breadcrumb">
        @for ($i = 1; $i <= 5; $i++)
            <div class="form-check {{ session('current_step') == $i ? 'active' : '' }}">
                <input class="form-check-input" type="radio" name="step" id="step{{ $i }}" value="{{ $i }}" {{ session('current_step') == $i ? 'checked' : '' }}>
                <label class="form-check-label {{ session('current_step') == $i ? 'active' : '' }}" for="step{{ $i }}">
                    {{ getBreadcrumb($i) }}
                </label>
            </div>
        @endfor
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 render_blade">
                @include('backend.properties.quick_form_components.step' . session('current_step', 1))  <!-- Default to step 1 -->
            </div>
        </div>
    </div>
</div>

@section('page.scripts')
<script>
    $(document).ready(function () {
        // General function to handle sending form data and navigating steps
        function handleStepChange(currentStep, targetStep) {
            // Validate the current step form (returns true if valid)
            const isValid = initValidate('#property-form-step-' + currentStep);
            if (isValid) {
                // Send form data for current step before moving on
                sendFormData(currentStep);

                // Update the active radio button to targetStep
                $('input[name="step"][value="' + targetStep + '"]').prop('checked', true);

                // Render the form for the target step
                // renderStep(targetStep);
            }
        }

        // Function to send form data for a specific step
        function sendFormData(step) {
            const formData = new FormData($('#property-form-step-' + step)[0]);
            formData.append('step', step);
            // Add property_id to the form data if it doesn't already exist
            const propertyId = $('#property_id').val();  // Get the property_id from the hidden input
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
                url: '{{ route("admin.properties.quick_store") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('.render_blade').html(response);
                },
                error: function (jqXHR) {
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
        //     const formStepRenderUrl = '{{ route("admin.properties.quick_step", ":step") }}'.replace(':step', step);
        // Define the URL based on the condition if $property exists
        @php
            $formStepRenderUrl = isset($property)
                ? route('admin.properties.quick_step', ['step' => ':step', 'property_id' => $property->id])
                : route('admin.properties.quick_step', ['step' => ':step']);
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
                success: function (response) {
                    $('.render_blade').html(response);

                    // Find id="property_id" and put the propertyId if it’s missing
                    if (!$('#property_id').val()) {
                        $('#property_id').val(propertyId);
                    }
                },
                error: function () {
                    toastr.error('Unable to load step. Please try again.', 'Error');
                }
            });
        }

        // Handle Next and Previous button clicks
        $(document).on('click', '.next-step, .previous-step', function (e) {
            e.preventDefault();
            const currentStep = $(this).data('current-step');
            const targetStep = $(this).hasClass('next-step') ? $(this).data('next-step') : $(this).data('previous-step');

            handleStepChange(currentStep, targetStep);
        });

        // Handle radio button change
        $('input[name="step"]').change(function () {
            const selectedStep = $(this).val();
            renderStep(selectedStep); // Render the corresponding Blade view
        });

        // Handle Next and Previous button clicks
        $(document).on('click', '.propertyType', function (e) {
            e.preventDefault();
            const currentStep3 = $('.next-step').data('current-step');
            const targetStep4 = $('.next-step').data('next-step');

            handleStepChange(currentStep3, targetStep4);
        });
        // Function to check if both Bedrooms and Reception Rooms have been selected
        function checkSelectionsAndSubmit() {
            const bedroomSelected = $('input[name="bedroom"]:checked').val();
            const receptionSelected = $('input[name="reception"]:checked').val();

            // If both Bedrooms and Reception Rooms are selected, submit the form
            if (bedroomSelected && receptionSelected) {
                const currentStep3 = $('.next-step').data('current-step');
                const targetStep4 = $('.next-step').data('next-step');

                handleStepChange(currentStep3, targetStep4);
            }
        }

        // Event listeners for Bedrooms and Reception Rooms radio buttons, class-based with delegation
        $(document).on('click', '.bedroom-radio', checkSelectionsAndSubmit);
        $(document).on('click', '.reception-radio', checkSelectionsAndSubmit);
    });

</script>
@endsection