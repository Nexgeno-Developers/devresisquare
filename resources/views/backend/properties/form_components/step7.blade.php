@php $currentStep = 7 ; @endphp
<!-- resources/views/backend/properties/form_components/step6.blade.php -->
@php
if(isset($property)){
    $propertyType = $property->property_type ?? '';
    $propertyPrice = $property->price ?? '';
    $lettingPrice = $property->letting_price ?? '';
    $groundRent = $property->ground_rent ?? '';
    $serviceCharge = $property->service_charge ?? '';
    $estateCharge = $property->estate_charge ?? '';
    $annualCouncilTax = $property->annual_council_tax ?? '';
    $councilTaxBand = $property->council_tax_band ?? '';
    $tenure = $property->tenure ?? '';
    $lengthOfLease = $property->length_of_lease ?? '';
}else{
    $propertyType = '';
    $propertyPrice = '';
    $lettingPrice = '';
    $groundRent = '';
    $serviceCharge = '';
    $estateCharge = '';
    $annualCouncilTax = '';
    $councilTaxBand = '';
    $tenure = '';
    $lengthOfLease = '';
}
@endphp

<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Price</label>

    <div class="property-form-data-attribute" data-step-name="Price" data-step-number="{{ $currentStep }}" data-step-title="Price"></div>

    <div class="row">
        <div class="col-lg-8 col-12">

            <div class="steps_wrapper">
                <div class="step_price">
                <!-- Listing Sale Price Input (Show only if type is sales or both) -->
                    @if($propertyType == 'sales' || $propertyType == 'both')
                        <div class="form-group">
                            <label for="lprice">Listing Sale Price</label>
                            <div class="price_input_wrapper">
                                <div class="pound_sign">{{ getPoundSymbol() }}</div>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $propertyPrice }}">
                            </div>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <!-- Letting Price Input (Show only if type is letting or both) -->
                    @if($propertyType == 'lettings' || $propertyType == 'both')
                        <div class="form-group">
                            <label for="letting_price">Letting Price</label>
                            <div class="price_input_wrapper">
                                <div class="pound_sign">{{ getPoundSymbol() }}</div>
                                <input type="text" name="letting_price" id="letting_price" class="form-control" value="{{ $lettingPrice }}">
                            </div>
                            @error('letting_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    @if($propertyType == 'sales' || $propertyType == 'both')
                    <div class="form-group">
                        <label for="ground_rent">Ground Rent</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">{{ getPoundSymbol() }}</div>
                            <input type="text" name="ground_rent" id="ground_rent" class="form-control" value="{{ $groundRent }}">
                        </div>
                        @error('ground_rent')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="service_charge">Service Charge</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">{{ getPoundSymbol() }}</div>
                            <input type="text" name="service_charge" id="service_charge" class="form-control" value="{{ $serviceCharge }}">
                        </div>
                        @error('service_charge')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estate_charge">Estate Charge</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">{{ getPoundSymbol() }}</div>
                            <input type="text" name="estate_charge" id="estate_charge" class="form-control" value="{{ $estateCharge }}">
                        </div>
                        @error('estate_charge')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="annual_council_tax">Annual Council Tax</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">{{ getPoundSymbol() }}</div>
                            <input type="text" name="annual_council_tax" id="annual_council_tax" class="form-control" value="{{ $annualCouncilTax }}">
                        </div>
                        @error('annual_council_tax')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="council_tax_band">Council Tax Band</label>
                        <div class="price_input_wrapper">
                            <div class="pound_sign">{{ getPoundSymbol() }}</div>
                            <input type="text" name="council_tax_band" id="council_tax_band" class="form-control" value="{{ $councilTaxBand }}">
                        </div>
                        @error('council_tax_band')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tenure">Tenure</label>
                        <select name="tenure" id="tenure" class="form-control">
                            <option value="leasehold" {{ isset($property) && $property->tenure == 'leasehold' ? 'selected' : '' }}>Leasehold</option>
                            <option value="freehold" {{ isset($property) && $property->tenure == 'freehold' ? 'selected' : '' }}>Freehold</option>
                            <option value="commonhold" {{ isset($property) && $property->tenure == 'commonhold' ? 'selected' : '' }}>Commonhold</option>
                            <option value="feudal" {{ isset($property) && $property->tenure == 'feudal' ? 'selected' : '' }}>Feudal</option>
                            <option value="share_of_freehold" {{ isset($property) && $property->tenure == 'share_of_freehold' ? 'selected' : '' }}>Share of Freehold</option>
                        </select>
                        @error('tenure')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($propertyType == 'sales' || $propertyType == 'both')
                    <div class="form-group">
                        <label for="length_of_lease">Length of Lease (in year)</label>
                        <input type="text" name="length_of_lease" id="length_of_lease" class="form-control" value="{{ $lengthOfLease }}">
                        @error('length_of_lease')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn_outline_secondary w-100 previous-step" data-previous-step="{{ $currentStep - 1 }}" data-current-step="{{ $currentStep }}">Previous</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn_secondary w-100 next-step" data-next-step="{{ $currentStep + 1 }}" data-current-step="{{ $currentStep }}">Next</button>
                </div>
            </div>
        </div>
    </div>
</form>
