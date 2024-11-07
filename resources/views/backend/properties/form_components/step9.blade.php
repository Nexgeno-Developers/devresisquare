<!-- resources/views/backend/properties/form_components/step9.blade.php -->
<form id="property-form-step-9" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Responsibility</label>

    <div class="steps_wrapper property-form-data-attribute" data-step-name="Responsibility" data-step-number="9" data-step-title="Responsibility">


        <div class="form-group">
            <label for="designation">Responsibility Designation</label>
            <select name="designation" id="designation" class="form-control">
                <option value="estate_agent" {{ old('designation') == 'estate_agent' ? 'selected' : '' }}>Estate Agent</option>
                <option value="landlord" {{ old('designation') == 'landlord' ? 'selected' : '' }}>Landlord</option>
                <option value="tenant" {{ old('designation') == 'tenant' ? 'selected' : '' }}>Tenant</option>
                <option value="manager" {{ old('designation') == 'manager' ? 'selected' : '' }}>Manager</option>
            </select>
            @error('designation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="branch">Branch</label>
            <select name="branch" id="branch" class="form-control">
                <option value="estate_agent" {{ old('branch') == 'estate_agent' ? 'selected' : '' }}>Estate Agent</option>
                <option value="landlord" {{ old('branch') == 'landlord' ? 'selected' : '' }}>Landlord</option>
                <option value="tenant" {{ old('branch') == 'tenant' ? 'selected' : '' }}>Tenant</option>
                <option value="manager" {{ old('branch') == 'manager' ? 'selected' : '' }}>Manager</option>
            </select>
            @error('branch')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="commission_percentage">Commission (%)</label>
            <select name="commission_percentage" id="commission_percentage" class="form-control">
                <option value="5" {{ old('commission_percentage') == '5' ? 'selected' : '' }}>5%</option>
                <option value="10" {{ old('commission_percentage') == '10' ? 'selected' : '' }}>10%</option>
                <option value="15" {{ old('commission_percentage') == '15' ? 'selected' : '' }}>15%</option>
                <option value="20" {{ old('commission_percentage') == '20' ? 'selected' : '' }}>20%</option>
            </select>
            @error('commission_percentage')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="commission_amount">Commission (£)</label>
            <select name="commission_amount" id="commission_amount" class="form-control">
                <option value="100" {{ old('commission_amount') == '100' ? 'selected' : '' }}>£100</option>
                <option value="200" {{ old('commission_amount') == '200' ? 'selected' : '' }}>£200</option>
                <option value="300" {{ old('commission_amount') == '300' ? 'selected' : '' }}>£300</option>
                <option value="400" {{ old('commission_amount') == '400' ? 'selected' : '' }}>£400</option>
            </select>
            @error('commission_amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-secondary w-100 previous-step" data-previous-step="8" data-current-step="9">Previous</button>
            </div>
            <div class="col-12 col-md-6">
                <button type="submit" class="btn btn-primary w-100 last-step-submit" data-current-step="9">Submit</button>
        </div> 
    </div> 

</form>
