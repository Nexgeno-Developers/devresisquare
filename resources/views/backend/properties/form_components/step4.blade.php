<!-- resources/views/backend/properties/form_components/step4.blade.php -->
<form id="property-form-step-4" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">
    
    <label class="main_title">Current Status</label>

    <div class="property-form-data-attribute" data-step-name="Current Status" data-step-number="4" data-step-title="Current Status"></div>

    <div class="form-group">
        <label for="current_status">Current Status</label>
        <select name="current_status" id="current_status" class="form-control">
            <option value="north" {{ old('current_status') == 'north' ? 'selected' : '' }}>North</option>
            <option value="south" {{ old('current_status') == 'south' ? 'selected' : '' }}>South</option>
            <option value="west" {{ old('current_status') == 'west' ? 'selected' : '' }}>West</option>
            <option value="east" {{ old('current_status') == 'east' ? 'selected' : '' }}>East</option>
        </select>
        @error('current_status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status_description">Description</label>
        <textarea name="status_description" id="status_description" class="form-control">{{ old('status_description') }}</textarea>
        @error('status_description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="available_from">Date of Availability</label>
        <input type="date" name="available_from" id="available_from" class="form-control" value="{{ old('available_from') }}">
        @error('available_from')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="market_on">Market On</label>
        <select name="market_on[]" id="market_on" class="form-control select2" multiple>
            <option value="resisquare" {{ (is_array(old('market_on')) && in_array('resisquare', old('market_on'))) ? 'selected' : '' }}>Resisquare</option>
            <option value="rightmove" {{ (is_array(old('market_on')) && in_array('rightmove', old('market_on'))) ? 'selected' : '' }}>Rightmove</option>
            <option value="zoopla" {{ (is_array(old('market_on')) && in_array('zoopla', old('market_on'))) ? 'selected' : '' }}>Zoopla</option>
            <option value="onthemarket" {{ (is_array(old('market_on')) && in_array('onthemarket', old('market_on'))) ? 'selected' : '' }}>OnTheMarket</option>
        </select>
        @error('market_on')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="button" class="btn btn-secondary previous-step" data-previous-step="3">Previous</button>
    <button type="button" class="btn btn-primary next-step" data-next-step="5">Next</button>
</form>
