<!-- resources/views/backend/properties/form_components/step1.blade.php -->
<form id="property-form-step-1" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <div class="property-form-data-attribute" data-step-name="Property Address" data-step-number="1"
        data-step-title="Property address"></div>
    <div class="form-group">
        <label for="prop_name">Property Name</label>
        <input required type="text" name="prop_name" id="prop_name" class="form-control"
            value="{{ session('prop_name') }}">
        @error('prop_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="line_1">Address Line 1</label>
        <input required type="text" name="line_1" id="line_1" class="form-control" value="{{ session('line_1') }}">
        @error('line_1')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="line_2">Address Line 2</label>
        <input type="text" name="line_2" id="line_2" class="form-control" value="{{ session('line_2') }}">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input required type="text" name="city" id="city" class="form-control" value="{{ session('city') }}">
        @error('city')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input required type="text" name="country" id="country" class="form-control" value="{{ session('country') }}">
        @error('country')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="postcode">Postcode</label>
        <input required type="text" name="postcode" id="postcode" class="form-control"
            value="{{ session('postcode') }}">
        @error('postcode')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="button" class="btn btn-primary next-step" data-next-step="2" data-current-step="1">Next</button>
</form>

