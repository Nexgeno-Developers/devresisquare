<!-- resources/views/backend/properties/form_components/step7.blade.php -->
<form id="property-form-step-7" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <div class="property-form-data-attribute" data-step-name="Valid EPC" data-step-number="7" data-step-title="Valid EPC"></div>
    
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
        <div>
            <input type="radio" name="is_gas" value="yes" {{ old('is_gas') == 'yes' ? 'checked' : '' }}> Yes
            <input type="radio" name="is_gas" value="no" {{ old('is_gas') == 'no' ? 'checked' : '' }}> No
        </div>
        @error('is_gas')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="button" class="btn btn-secondary previous-step" data-previous-step="6">Previous</button>
    <button type="button" class="btn btn-primary next-step" data-next-step="8">Next</button>
</form>
