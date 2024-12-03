@php $currentStep = 6 ; @endphp
<!-- resources/views/backend/properties/form_components/step6.blade.php -->


<form id="property-form-step-{{ $currentStep }}" class="rs_steps" method="POST"
    action="{{ route('admin.properties.store') }}">
    @csrf
    <!-- Hidden field for property ID with isset check -->
    <input type="hidden" id="property_id" class="property_id" name="property_id"
        value="{{ session('property_id') ?? (isset($property) ? $property->id : '') }}">

    <label class="main_title">Accessiblity</label>

    <div class="property-form-data-attribute" data-step-name="Accessiblity" data-step-number="{{ $currentStep }}"
        data-step-title="Accessiblity"></div>

    <div class="row h_100_vh">
        <div class="col-lg-6 col-12">

            <div class="steps_wrapper">

                {{-- <div class="form-group">
                    <x-backend.input-comp class="" inputOpt="input_custom_icon" inputType="text" rightIcon=""
                        inputName="school_name" placeHolder="School Name" isLabel={{ false }}
                        label="Nearest School" isDate={{ false }} isIcon={{ true }} iconName="bi-plus"
                        onIconClick="onIconClick" />
                    @error('school_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul class="input_list_items">
                        <li><span>Hampton High</span> <i class="bi bi-x-lg x_icon"></i> </li>
                        <li><span>Tower House School</span> <i class="bi bi-x-lg x_icon"></i></li>
                    </ul>
                </div> --}}
                {{-- <div class="form-group">
                    <x-backend.input-comp class="" inputOpt="input_custom_icon" inputType="text" rightIcon=""
                        inputName="relegious_places" placeHolder="Relegious Places" isLabel={{ false }}
                        label="Nearest Relegious Places" isDate={{ false }} isIcon={{ true }}
                        iconName="bi-plus" onIconClick="onIconClick" />
                    @error('relegious_places')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <ul class="input_list_items">
                        <li><span>Tonbridge Street</span> <i class="bi bi-x-lg x_icon"></i> </li>
                        <li><span>East Sheen</span> <i class="bi bi-x-lg x_icon"></i></li>
                    </ul>
                </div> --}}
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
                <!-- Nearest Station -->
                <div class="form-group">
                    <div class="rs_sub_title">Nearest Station</div>
                    @php
                        // If nearest_station is not null, decode the comma-separated string into an array
                        $stations =
                            isset($property) && $property->nearest_station
                                ? explode(',', $property->nearest_station) // Convert to an array of IDs
                                : [];
                    @endphp
                    <input id="station_name" type="text" class="tagify-input" placeholder="Station Name">
                    <input type="hidden" name="nearest_station" value="{{ $property->nearest_station }}"
                        class="hidden-input" required>
                    @error('nearest_station')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nearest School -->
                <div class="form-group">
                    <div class="rs_sub_title">Nearest School</div>
                    @php
                        // If nearest_school is not null, decode the comma-separated string into an array
                        $schools =
                            isset($property) && $property->nearest_school
                                ? explode(',', $property->nearest_school) // Convert to an array of IDs
                                : [];
                    @endphp
                    <input id="school_name" type="text" class="tagify-input" placeholder="School Name">
                    <input type="hidden" name="nearest_school" value="{{ implode(',', $schools) }}"
                        class="hidden-input" required>
                    @error('nearest_school')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <div class="rs_sub_title">Nearest Religious Places (Distance in KM)</div>
                    @php
                        // If nearest_religious_places is not null, decode the JSON and use it; otherwise, use empty values
                        $religiousPlaces =
                            isset($property) && $property->nearest_religious_places
                                ? json_decode($property->nearest_religious_places)
                                : ['masjid' => '', 'church' => '', 'mandir' => ''];
                    @endphp
                    <input type="number" pattern="[0-9]" class="form-control mt-2" inputmode="numeric"
                        name="nearest_religious_places[masjid]" value="{{ $religiousPlaces->masjid ?? '' }}"
                        placeholder="Masjid" required>
                    <input type="number" pattern="[0-9]" class="form-control mt-2" inputmode="numeric"
                        name="nearest_religious_places[church]" value="{{ $religiousPlaces->church ?? '' }}"
                        placeholder="Church" required>
                    <input type="number" pattern="[0-9]" class="form-control mt-2" inputmode="numeric"
                        name="nearest_religious_places[mandir]" value="{{ $religiousPlaces->mandir ?? '' }}"
                        placeholder="Mandir" required>
                    @error('nearest_religious_places')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="useful_information">Useful Information</label>
                    <input type="text" name="useful_information" id="useful_information" class="form-control"
                        value="{{ isset($property) && $property->useful_information ? $property->useful_information : '' }}"
                        required>
                    @error('useful_information')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="footer_btn">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn_outline_secondary w-100 previous-step"
                                data-previous-step="{{ $currentStep - 1 }}"
                                data-current-step="{{ $currentStep }}">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn_secondary w-100 next-step"
                                data-next-step="{{ $currentStep + 1 }}"
                                data-current-step="{{ $currentStep }}">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@section('page.scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stations = @json($allstations); // Fetch all station names with IDs
            const schools = @json($allschools); // Fetch all school names with IDs

            // Utility function to initialize Tagify
            function initTagify(inputSelector, hiddenInputSelector, data, type) {
                const inputElement = document.querySelector(inputSelector);
                const hiddenInput = document.querySelector(hiddenInputSelector);

                const tagify = new Tagify(inputElement, {
                    whitelist: data.map(item => item.name), // Map to get only names
                    maxTags: 5,
                    dropdown: {
                        enabled: 0 // Disable dropdown
                    }
                });

                // Handle adding a new tag
                tagify.on('add', function(e) {
                    const newTag = e.detail.data; // The tag that was just added
                    const selectedItem = data.find(item => item.name === newTag.value);
                    if (selectedItem) {
                        const selectedIds = tagify.value.map(tag => {
                            const item = data.find(item => item.name === tag.value);
                            return item ? item.id : null;
                        });
                        hiddenInput.value = selectedIds.join(','); // Store as comma-separated string
                    }
                });

                // Handle removing a tag
                tagify.on('remove', function(e) {
                    const removedTag = e.detail.data; // The tag that was just removed
                    const selectedItem = data.find(item => item.name === removedTag.value);
                    if (selectedItem) {
                        const selectedIds = tagify.value.map(tag => {
                            const item = data.find(item => item.name === tag.value);
                            return item ? item.id : null;
                        });
                        hiddenInput.value = selectedIds.join(','); // Store as comma-separated string
                    }
                });

                // Populate Tagify with existing selected items
                if (Array.isArray(data) && data.length > 0) {
                    const selectedTags = type === 'station' ? {!! json_encode($stations) !!} :
                    {!! json_encode($schools) !!}; // The selected IDs from the database
                    const selectedNames = selectedTags.map(id => {
                        const item = data.find(item => item.id == id);
                        return item ? item.name : '';
                    });
                    tagify.addTags(selectedNames);
                }
            }

            // Initialize Tagify for stations and schools
            initTagify('#station_name', 'input[name="nearest_station"]', stations, 'station');
            initTagify('#school_name', 'input[name="nearest_school"]', schools, 'school');
        });
    </script>
@endsection
