<!-- resources/views/backend/properties/form_components/step3.blade.php -->
<form id="property-form-step-3" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <div class="property-form-data-attribute" data-step-name="Property Information" data-step-number="3" data-step-title="Property Information"></div>
    <div class="form-group">
        <label>Bedrooms</label>
        <div>
            <input type="radio" name="bedroom" value="studio" {{ old('bedroom') == 'studio' ? 'checked' : '' }}> Studio
            <input type="radio" name="bedroom" value="1" {{ old('bedroom') == '1' ? 'checked' : '' }}> 1
            <input type="radio" name="bedroom" value="2" {{ old('bedroom') == '2' ? 'checked' : '' }}> 2
            <input type="radio" name="bedroom" value="3" {{ old('bedroom') == '3' ? 'checked' : '' }}> 3
            <input type="radio" name="bedroom" value="4" {{ old('bedroom') == '4' ? 'checked' : '' }}> 4
            <input type="radio" name="bedroom" value="5" {{ old('bedroom') == '5' ? 'checked' : '' }}> 5
            <input type="radio" name="bedroom" value="6+" {{ old('bedroom') == '6+' ? 'checked' : '' }}> 6+
        </div>
        @error('bedroom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Bathrooms</label>
        <div>
            <input type="radio" name="bathroom" value="1" {{ old('bathroom') == '1' ? 'checked' : '' }}> 1
            <input type="radio" name="bathroom" value="2" {{ old('bathroom') == '2' ? 'checked' : '' }}> 2
            <input type="radio" name="bathroom" value="3" {{ old('bathroom') == '3' ? 'checked' : '' }}> 3
            <input type="radio" name="bathroom" value="4" {{ old('bathroom') == '4' ? 'checked' : '' }}> 4
            <input type="radio" name="bathroom" value="5" {{ old('bathroom') == '5' ? 'checked' : '' }}> 5
            <input type="radio" name="bathroom" value="6+" {{ old('bathroom') == '6+' ? 'checked' : '' }}> 6+
        </div>
        @error('bathroom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Reception Rooms</label>
        <div>
            <input type="radio" name="reception" value="1" {{ old('reception') == '1' ? 'checked' : '' }}> 1
            <input type="radio" name="reception" value="2" {{ old('reception') == '2' ? 'checked' : '' }}> 2
            <input type="radio" name="reception" value="3" {{ old('reception') == '3' ? 'checked' : '' }}> 3
            <input type="radio" name="reception" value="4" {{ old('reception') == '4' ? 'checked' : '' }}> 4
            <input type="radio" name="reception" value="5" {{ old('reception') == '5' ? 'checked' : '' }}> 5
            <input type="radio" name="reception" value="6+" {{ old('reception') == '6+' ? 'checked' : '' }}> 6+
        </div>
        @error('reception')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
            <label>Parking</label><br>
            <input type="radio" name="parking" value="0" {{ old('parking') == '0' ? 'checked' : '' }}> No<br>
            <input type="radio" name="parking" value="1" {{ old('parking') == '1' ? 'checked' : '' }}> Yes<br>
            @error('parking')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Balcony</label><br>
            <input type="radio" name="balcony" value="0" {{ old('balcony') == '0' ? 'checked' : '' }}> No<br>
            <input type="radio" name="balcony" value="1" {{ old('balcony') == '1' ? 'checked' : '' }}> Yes<br>
            @error('balcony')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Garden</label><br>
            <input type="radio" name="garden" value="0" {{ old('garden') == '0' ? 'checked' : '' }}> No<br>
            <input type="radio" name="garden" value="1" {{ old('garden') == '1' ? 'checked' : '' }}> Yes<br>
            @error('garden')
                <div class="text-danger">{{ $message }}</div>
            @enderror
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
            <label>Collecting Rent</label><br>
            <input type="radio" name="collecting_rent" value="0" {{ old('collecting_rent') == '0' ? 'checked' : '' }}> No<br>
            <input type="radio" name="collecting_rent" value="1" {{ old('collecting_rent') == '1' ? 'checked' : '' }}> Yes<br>
            @error('collecting_rent')
                <div class="text-danger">{{ $message }}</div>
            @enderror
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
            <input type="number" name="square_feet" class="form-control" placeholder="Square Feet" value="{{ old('square_feet') }}">
            <input type="number" name="square_meter" class="form-control" placeholder="Square Meter" value="{{ old('square_meter') }}">
            @error('square_feet')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @error('square_meter')
                <div class="text-danger">{{ $message }}</div>
            @enderror
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
    </div>

    <button type="button" class="btn btn-secondary previous-step" data-previous-step="2">Previous</button>
    <button type="button" class="btn btn-primary next-step" data-next-step="4">Next</button>
</form>
