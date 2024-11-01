<!-- resources/views/backend/properties/form_components/step2.blade.php -->
<form id="property-form-step-2" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <div class="property-form-data-attribute" data-step-name="Property Type" data-step-number="2" data-step-title="Property Type" ></div>
    <label class="main_title">Property Type</label>
    <div class="steps_wrapper">
        <div class="form-group">
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="property_type" value="sales" {{ old('property_type') == 'sales' ? 'checked' : '' }} /> 
                    <label for="property_type" >Sales </label>
                </div>
                <div>
                    <input type="radio" name="property_type" value="lettings" {{ old('property_type') == 'lettings' ? 'checked' : '' }} /> 
                    <label for="property_type"> Lettings </label>
                </div>
                <div>
                    <input type="radio" name="property_type" value="both" {{ old('property_type') == 'both' ? 'checked' : '' }} /> 
                    <label for="property_type"> Both </label>
                </div>
            </div>
            @error('property_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Transaction Type</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="transaction_type" value="residential" {{ old('transaction_type') == 'residential' ? 'checked' : '' }} /> 
                    <label for="transaction_type" > Residential</label>
                </div>
                <div>
                    <input type="radio" name="transaction_type" value="commercial" {{ old('transaction_type') == 'commercial' ? 'checked' : '' }} />
                    <label for="transaction_type" > Commercial</label>
                </div>
            </div>
            @error('transaction_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Specific Property Type</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="specific_property_type" value="appartment" {{ old('specific_property_type') == 'appartment' ? 'checked' : '' }}> 
                    <label for="specific_property_type" > Appartment</label>
                </div>
                <div>
                    <input type="radio" name="specific_property_type" value="flat" {{ old('specific_property_type') == 'flat' ? 'checked' : '' }}> 
                    <label for="specific_property_type" > Flat</label>
                </div>
                <div>
                    <input type="radio" name="specific_property_type" value="bunglow" {{ old('specific_property_type') == 'bunglow' ? 'checked' : '' }}> 
                    <label for="specific_property_type" > Bunglow</label>
                </div>
                <div>
                    <input type="radio" name="specific_property_type" value="house" {{ old('specific_property_type') == 'house' ? 'checked' : '' }}> 
                    <label for="specific_property_type" > House</label>
                </div>
            </div>
            @error('specific_property_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-secondary previous-step w-100" data-previous-step="1" data-current-step="2">Previous</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-primary next-step w-100" data-next-step="3" data-current-step="2">Next</button>
            </div>
        </div> 
        
        
    </div>
</form>
