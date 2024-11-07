<!-- resources/views/backend/properties/form_components/form.blade.php -->
@extends('backend.layout.app')

@section('content')
@php
    function getBreadcrumb($step)
    {
        $breadcrumb = [
            1 => 'Property name',
            2 => 'Property Address',
            3 => 'Property Type',
            4 => 'Property Information',
            5 => 'Rooms',
            6 => 'Price',
        ];

        return $breadcrumb[$step] ?? 'Unknown Step';
    }
@endphp

<div class="">
    <h4 class="mb-4">Quick Add Property</h4>
    <div class="qap_breadcrumb">
        @for ($i = 1; $i <= 6; $i++)
            <div class="form-check {{ session('current_step') == $i ? 'active' : '' }}">
                <input class="form-check-input" type="radio" name="step" id="step{{ $i }}" value="{{ $i }}" {{ session('current_step') == $i ? 'checked' : '' }}>
                <label class="form-check-label {{ session('current_step') == $i ? 'active' : '' }}"
                    for="step{{ $i }}">
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
@endsection



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

            $.ajax({
                url: '{{ route("admin.properties.store") }}',
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
        function renderStep(step) {
            const formStepRenderUrl = '{{ route("admin.properties.quick_step", ":step") }}'.replace(':step', step);

            $.ajax({
                url: formStepRenderUrl,
                method: 'GET',
                success: function (response) {
                    $('.render_blade').html(response);
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

    });

</script>
@endsection
