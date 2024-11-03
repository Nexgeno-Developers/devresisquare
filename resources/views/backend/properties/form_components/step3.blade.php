<!-- resources/views/backend/properties/form_components/step3.blade.php -->
<form id="property-form-step-3" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <label class="main_title">Property Information</label>

    <div class="property-form-data-attribute" data-step-name="Property Information" data-step-number="3" data-step-title="Property Information"></div>
    <div class="steps_wrapper">
        <div class="form-group">
            <label>Bedrooms</label>
            <div class="radio_bts_square">
                <input type="radio" name="bedroom" id="bedroomStudio" value="studio" {{ old('bedroom') == 'studio' ? 'checked' : '' }}> <label for="bedroomStudio">Studio </label>
                <input type="radio" name="bedroom" id="bedroom1" value="1" {{ old('bedroom') == '1' ? 'checked' : '' }}> <label for="bedroom1">1 </label>
                <input type="radio" name="bedroom" id="bedroom2" value="2" {{ old('bedroom') == '2' ? 'checked' : '' }}> <label for="bedroom2">2 </label>
                <input type="radio" name="bedroom" id="bedroom3" value="3" {{ old('bedroom') == '3' ? 'checked' : '' }}> <label for="bedroom3">3 </label>
                <input type="radio" name="bedroom" id="bedroom4" value="4" {{ old('bedroom') == '4' ? 'checked' : '' }}> <label for="bedroom4">4 </label>
                <input type="radio" name="bedroom" id="bedroom5" value="5" {{ old('bedroom') == '5' ? 'checked' : '' }}> <label for="bedroom5">5 </label>
                <input type="radio" name="bedroom" id="bedroom6" value="6+" {{ old('bedroom') == '6+' ? 'checked' : '' }}> <label for="bedroom6">6+ </label>
            </div>
            @error('bedroom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Bathrooms</label>
            <div class="radio_bts_square">
                <input type="radio" name="bathroom" id="bathroom1" value="1" {{ old('bathroom') == '1' ? 'checked' : '' }}> <label for="bathroom1">1 </label>
                <input type="radio" name="bathroom" id="bathroom2" value="2" {{ old('bathroom') == '2' ? 'checked' : '' }}> <label for="bathroom2">2 </label>
                <input type="radio" name="bathroom" id="bathroom3" value="3" {{ old('bathroom') == '3' ? 'checked' : '' }}> <label for="bathroom3">3 </label>
                <input type="radio" name="bathroom" id="bathroom4" value="4" {{ old('bathroom') == '4' ? 'checked' : '' }}> <label for="bathroom4">4 </label>
                <input type="radio" name="bathroom" id="bathroom5" value="5" {{ old('bathroom') == '5' ? 'checked' : '' }}> <label for="bathroom4">5</label>
                <input type="radio" name="bathroom" id="bathroom6" value="6+" {{ old('bathroom') == '6+' ? 'checked' : '' }}> <label for="bathrrom6">6+ </label>
            </div>
            @error('bathroom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Reception Rooms</label>
            <div class="radio_bts_square">
                <input type="radio" name="reception" id="reception1" value="1" {{ old('reception') == '1' ? 'checked="checked"' : '' }} /> 
                <label for="reception1"> 1 </label>
                <input type="radio" name="reception" id="reception2" value="2" {{ old('reception') == '2' ? 'checked="checked"' : '' }} /> 
                <label for="reception2"> 2 </label>
                <input type="radio" name="reception" id="reception3" value="3" {{ old('reception') == '3' ? 'checked="checked"' : '' }} /> 
                <label for="reception3"> 3 </label>
                <input type="radio" name="reception" id="reception4" value="4" {{ old('reception') == '4' ? 'checked="checked"' : '' }} /> 
                <label for="reception4"> 4 </label>
                <input type="radio" name="reception" id="reception5" value="5" {{ old('reception') == '5' ? 'checked="checked"' : '' }} /> 
                <label for="reception5"> 5 </label>
                <input type="radio" name="reception" id="reception6" value="6+" {{ old('reception') == '6+' ? 'checked="checked"' : '' }} /> 
                <label for="reception6">6+</label>
            </div>
            @error('reception')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Parking</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="parking" value="0" {{ old('parking') == '0' ? 'checked' : '' }} /> 
                    <label for="parking" > No</label>
                </div>
                <div>
                    <input type="radio" name="parking" value="1" {{ old('parking') == '1' ? 'checked' : '' }} /> 
                    <label for="parking" > Yes</label>
                </div>
                @error('parking')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Balcony</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="balcony" value="0" {{ old('balcony') == '0' ? 'checked' : '' }} /> 
                    <label for="balcony" > No</label>
                </div>
                <div>
                    <input type="radio" name="balcony" value="1" {{ old('balcony') == '1' ? 'checked' : '' }} /> 
                    <label for="balcony" > Yes</label>
                </div>
                @error('balcony')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
        </div>

        <div class="form-group">
            <label>Garden</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="garden" value="0" {{ old('garden') == '0' ? 'checked' : '' }} /> 
                    <label for="garden" > No</label>
                </div>
                <div>
                    <input type="radio" name="garden" value="1" {{ old('garden') == '1' ? 'checked' : '' }} /> 
                    <label for="garden" > Yes</label>
                </div>
                @error('garden')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Service</label>
            <select name="service" class="form-control">
                <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select a service</option>
                <option value="let only1" {{ old('service') == 'let only1' ? 'selected' : '' }}>Let Only 1</option>
                <option value="let only2" {{ old('service') == 'let only2' ? 'selected' : '' }}>Let Only 2</option>
            </select>
            @error('service')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Collecting Rent</label>
            <div class="rs_radio_btns">
                <div>
                    <input type="radio" name="collecting_rent" value="0" {{ old('collecting_rent') == '0' ? 'checked' : '' }} /> 
                    <label for="collecting_rent" > No</label>
                </div>
                <div>
                    <input type="radio" name="collecting_rent" value="1" {{ old('collecting_rent') == '1' ? 'checked' : '' }} /> 
                    <label for="collecting_rent" > Yes</label>
                </div>
                @error('collecting_rent')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Floor</label>
            <select name="floor" class="form-control">
                <option value="" disabled {{ old('floor') ? '' : 'selected' }}>Select a floor</option>
                <option value="let only1" {{ old('floor') == 'let only1' ? 'selected' : '' }}>Let Only 1</option>
                <option value="let only2" {{ old('floor') == 'let only2' ? 'selected' : '' }}>Let Only 2</option>
            </select>
            @error('floor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Area</label>
            <div class="row">
                <div class="col">
                    <input type="number" name="square_feet" class="form-control" placeholder="Square Feet" value="{{ old('square_feet') }}">
                    @error('square_feet')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <input type="number" name="square_meter" class="form-control" placeholder="Square Meter" value="{{ old('square_meter') }}">
                    @error('square_meter')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Aspects</label>
            <select name="aspects" class="form-control">
                <option value="" disabled {{ old('aspects') ? '' : 'selected' }}>Select an aspect</option>
                <option value="north" {{ old('aspects') == 'north' ? 'selected' : '' }}>North</option>
                <option value="south" {{ old('aspects') == 'south' ? 'selected' : '' }}>South</option>
                <option value="west" {{ old('aspects') == 'west' ? 'selected' : '' }}>West</option>
                <option value="east" {{ old('aspects') == 'east' ? 'selected' : '' }}>East</option>
            </select>
            @error('aspects')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>    
        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-secondary w-100 previous-step w-100" data-previous-step="2">Previous</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-primary w-100 next-step w-100" data-next-step="4">Next</button>
            </div>
        </div>    
    </div>
</form>
