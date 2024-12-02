@php $currentStep = 6 ; @endphp
<!-- resources/views/backend/properties/form_components/step6.blade.php -->


<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST" action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id" value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Accessiblity</label>

    <div class="property-form-data-attribute" data-step-name="Accessiblity" data-step-number="{{ $currentStep }}" data-step-title="Accessiblity"></div>

    <div class="row">
        <div class="col-lg-6 col-12">

            <div class="steps_wrapper">
                <div class="form-group">
                    <div class="rs_sub_title">Access Arrangement</div>
                    <textarea name="access_arrangement" required>{{ isset($property) && $property->access_arrangement ? $property->access_arrangement : '' }}</textarea>
                    @error('access_arrangement')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="rs_sub_title">Key Highlights</div>
                    <textarea name="key_highlights" required>{{ isset($property) && $property->key_highlights ? $property->key_highlights : '' }}</textarea>
                    @error('key_highlights')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="rs_sub_title">Nearest Station</div>
                    @php
                        // If nearest_station is not null, decode the JSON and use it; otherwise, use an empty array
                        $stations = isset($property) && $property->nearest_station ? json_decode($property->nearest_station) : ['', '', '', ''];
                    @endphp
                    @foreach ($stations as $index => $station)
                        <input type="text" name="nearest_station[]" value="{{ $station ?? '' }}" required>
                    @endforeach
                    @error('nearest_station')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="rs_sub_title">Nearest School</div>
                    @php
                        // If nearest_school is not null, decode the JSON and use it; otherwise, use an empty array
                        $schools = isset($property) && $property->nearest_school ? json_decode($property->nearest_school) : ['', '', '', ''];
                    @endphp
                    @foreach ($schools as $index => $school)
                        <input type="text" name="nearest_school[]" value="{{ $school ?? '' }}" required>
                    @endforeach
                    @error('nearest_school')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="rs_sub_title">Nearest Religious Places</div>
                    @php
                        // If nearest_religious_places is not null, decode the JSON and use it; otherwise, use empty values
                        $religiousPlaces = isset($property) && $property->nearest_religious_places ? json_decode($property->nearest_religious_places) : ['masjid' => '', 'church' => '', 'mandir' => ''];
                    @endphp
                    <input type="text" name="nearest_religious_places[masjid]" value="{{ $religiousPlaces->masjid ?? '' }}" placeholder="Masjid (Distance in KM)" required>
                    <input type="text" name="nearest_religious_places[church]" value="{{ $religiousPlaces->church ?? '' }}" placeholder="Church (Distance in KM)" required>
                    <input type="text" name="nearest_religious_places[mandir]" value="{{ $religiousPlaces->mandir ?? '' }}" placeholder="Mandir (Distance in KM)" required>
                    @error('nearest_religious_places')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="useful_information">Useful Information</label>
                    <input type="text" name="useful_information" id="useful_information" class="form-control" value="{{ isset($property) && $property->useful_information ? $property->useful_information : '' }}" required>
                    @error('useful_information')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
