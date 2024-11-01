<!-- resources/views/backend/properties/form_components/step7.blade.php -->
<form id="property-form-step-7" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <label class="main_title">Valid EPC</label>

    <div class="property-form-data-attribute" data-step-name="Valid EPC" data-step-number="7" data-step-title="Valid EPC"></div>
    
    <div class="steps_wrapper">
        <div class="form-group">
            <label for="epc_rating">EPC Rating</label>
            <select name="epc_rating" id="epc_rating" class="form-control">
                <option value="A" {{ old('epc_rating') == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('epc_rating') == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('epc_rating') == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('epc_rating') == 'D' ? 'selected' : '' }}>D</option>
            </select>
            @error('epc_rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Does the property have gas?</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="is_gas" value="0" {{ old('is_gas') == 'no' ? 'checked' : '' }} /> 
                    <label for="is_gas" > No</label>
                </div>
                <div>
                    <input type="radio" name="is_gas" value="1" {{ old('is_gas') == 'yes' ? 'checked' : '' }} /> 
                    <label for="is_gas" > Yes</label>
                </div>
                @error('is_gas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-secondary w-100 previous-step" data-previous-step="6">Previous</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-primary w-100 next-step" data-next-step="8">Next</button>
        </div> 
    </div> 
</form>
