@php $currentStep = 8 ; @endphp
<!-- resources/views/backend/properties/form_components/step7.blade.php -->
@php
if(isset($property)){
    $epcRating = $property->epc_rating ?? '';
    $isGas = $property->is_gas ?? '';
}else{
    $epcRating = '';
    $isGas = '';
}
@endphp
<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Valid EPC</label>

    <div class="property-form-data-attribute" data-step-name="Valid EPC" data-step-number="{{ $currentStep }}" data-step-title="Valid EPC"></div>
    
    <div class="row">
        <div class="col-lg-6 col-12">

            <div class="steps_wrapper">
                <div class="form-group">
                    <label for="epc_rating">EPC Rating</label>
                    <select name="epc_rating" id="epc_rating" class="form-control">
                        <option value="A" {{ $epcRating == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $epcRating == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $epcRating == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $epcRating == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                    @error('epc_rating')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Does the property have gas?</label>
                    <div class="rs_radio_btns">
                        <div>
                            <input type="radio" name="is_gas" id="is_gas_no" value="0" {{ $isGas == '0' ? 'checked' : '' }} /> 
                            <label for="is_gas_no" > No</label>
                        </div>
                        <div>
                            <input type="radio" name="is_gas" id="is_gas_yes" value="1" {{ $isGas == '1' ? 'checked' : '' }} /> 
                            <label for="is_gas_yes" > Yes</label>
                        </div>
                        @error('is_gas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="footer_btn">
                    <div class="row ">
                        <div class="col-6">
                            <button type="button" class="btn btn_outline_secondary w-100 previous-step" data-previous-step="{{ $currentStep - 1 }}" data-current-step="{{ $currentStep }}">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn_secondary w-100 next-step" data-next-step="{{ $currentStep + 1 }}" data-current-step="{{ $currentStep }}">Next</button>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</form>
