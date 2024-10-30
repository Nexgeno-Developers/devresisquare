<!-- resources/views/backend/properties/form_components/step2.blade.php -->
<form id="property-form-step-2" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <div class="property-form-data-attribute" data-step-name="Property Type" data-step-number="2" data-step-title="Property Type" ></div>
    <div class="form-group">
        <label>Property Type</label>
        <div>
            <input type="radio" name="property_type" value="sales" {{ old('property_type') == 'sales' ? 'checked' : '' }}> Sales
            <input type="radio" name="property_type" value="lettings" {{ old('property_type') == 'lettings' ? 'checked' : '' }}> Lettings
            <input type="radio" name="property_type" value="both" {{ old('property_type') == 'both' ? 'checked' : '' }}> Both
        </div>
        @error('property_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Transaction Type</label>
        <div>
            <input type="radio" name="transaction_type" value="residential" {{ old('transaction_type') == 'residential' ? 'checked' : '' }}> Residential
            <input type="radio" name="transaction_type" value="commercial" {{ old('transaction_type') == 'commercial' ? 'checked' : '' }}> Commercial
        </div>
        @error('transaction_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Specific Property Type</label>
        <div>
            <input type="radio" name="specific_property_type" value="appartment" {{ old('specific_property_type') == 'appartment' ? 'checked' : '' }}> Appartment
            <input type="radio" name="specific_property_type" value="flat" {{ old('specific_property_type') == 'flat' ? 'checked' : '' }}> Flat
            <input type="radio" name="specific_property_type" value="bunglow" {{ old('specific_property_type') == 'bunglow' ? 'checked' : '' }}> Bunglow
            <input type="radio" name="specific_property_type" value="house" {{ old('specific_property_type') == 'house' ? 'checked' : '' }}> House
        </div>
        @error('specific_property_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="button" class="btn btn-secondary previous-step" data-previous-step="1" data-current-step="2">Previous</button>
    <button type="button" class="btn btn-primary next-step" data-next-step="3" data-current-step="2">Next</button>
</form>
