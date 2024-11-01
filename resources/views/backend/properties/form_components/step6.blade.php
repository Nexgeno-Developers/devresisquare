<!-- resources/views/backend/properties/form_components/step6.blade.php -->
<form id="property-form-step-6" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? old('property_id') }}">

    <label class="main_title">Price</label>

    <div class="property-form-data-attribute" data-step-name="Price" data-step-number="6" data-step-title="Price"></div>

    <div class="form-group">
        <label for="price">Sale Price</label>
        <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="ground_rent">Ground Rent</label>
        <input type="text" name="ground_rent" id="ground_rent" class="form-control" value="{{ old('ground_rent') }}">
        @error('ground_rent')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="service_charge">Service Charge</label>
        <input type="text" name="service_charge" id="service_charge" class="form-control" value="{{ old('service_charge') }}">
        @error('service_charge')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="annual_council_tax">Annual Council Tax</label>
        <input type="text" name="annual_council_tax" id="annual_council_tax" class="form-control" value="{{ old('annual_council_tax') }}">
        @error('annual_council_tax')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="council_tax_band">Council Tax Band</label>
        <input type="text" name="council_tax_band" id="council_tax_band" class="form-control" value="{{ old('council_tax_band') }}">
        @error('council_tax_band')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="listing_sale_price">Listing Sale Price</label>
        <input type="text" name="listing_sale_price" id="listing_sale_price" class="form-control" value="{{ old('listing_sale_price') }}">
        @error('listing_sale_price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="tenure">Tenure</label>
        <select name="tenure" id="tenure" class="form-control">
            <option value="leasehold" {{ old('tenure') == 'leasehold' ? 'selected' : '' }}>Leasehold</option>
            <option value="leasehold2" {{ old('tenure') == 'leasehold2' ? 'selected' : '' }}>Leasehold 2</option>
        </select>
        @error('tenure')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="length_of_lease">Length of Lease</label>
        <input type="text" name="length_of_lease" id="length_of_lease" class="form-control" value="{{ old('length_of_lease') }}">
        @error('length_of_lease')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="button" class="btn btn-secondary previous-step" data-previous-step="5">Previous</button>
    <button type="button" class="btn btn-primary next-step" data-next-step="7">Next</button>
</form>
