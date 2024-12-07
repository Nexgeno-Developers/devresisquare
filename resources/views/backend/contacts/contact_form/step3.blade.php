<!-- resources/views/backend/properties/quick_form_components/step4.blade.php -->
@php $currentStep = 3 ; @endphp
<div class="container-fluid mt-4 quick_add_contact">
    <div class="row">
        <div class="col-md-6 col-12 left_col">
            <div class="left_content_wrapper">
                <div class="left_title">
                    Add <span class="secondary-color">Properties</span><br /> related to this
                    contact
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 right_col">
            <form id="contact-form-step-{{$currentStep}}" method="POST" action="{{ route('admin.properties.quick_store') }}">
                @csrf
                <!-- Hidden field for contact ID with isset check -->
                <input type="hidden" name="step" value="{{ $currentStep }}">
                <input type="hidden" id="contact_id" class="contact_id" name="contact_id" value="{{ isset($contact) ? $contact->id : '' }}">

                <!-- Search input field -->
                <label for="property_search">Search Properties</label>
                <input type="text" id="property_search" name="property_search" placeholder="Search by ref_no, name, address..." class="form-control">

                <!-- Container for showing search results -->
                <ul id="property_results" class="list-group mt-2"></ul>

                <!-- Hidden input to store selected property ID -->
                <input type="hidden" id="property_id" name="property_id">




                <div class="steps_wrapper">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="from-group mt-lg-0 mt-4">
                                <label class="mb-2" for="search_property">Search Property</label>
                                <div class="row">
                                    <div class="col-8">

                                        <!-- Search input field for properties -->
                                        <div class="form-group">
                                            <label for="search_property1">Search for Properties:</label>
                                            <input type="text" id="search_property1" class="form-control" placeholder="Start typing to search...">
                                            <div id="error_message" style="color: red; display: none;"></div>
                                        </div>

                                        <!-- Search results container -->
                                        <ul id="property_results" class="list-group mt-2">
                                            <!-- Property search results will be displayed here -->
                                        </ul>

                                        <!-- Selected properties container -->
                                        <div id="selected_properties" class="mt-3">
                                            <!-- Selected properties will be displayed here -->
                                            <!-- Example of a selected property:
                                            <div class="selected-property" data-id="123">
                                                <span>Property Ref: 123 - Property Name (City)</span>
                                                <button type="button" class="btn btn-warning btn-sm remove-property" data-id="123">Remove</button>
                                            </div>
                                            -->
                                        </div>

                                        <div class="rs_input input_search">
                                            <input type="text" id="search_property" name="search_property" placeholder="Search Property" />
                                            <div class="right_icon"><i class="bi bi-search"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="from-group">
                                            <x-backend.forms.button
                                                class="w-100"
                                                name="Attach"
                                                type="secondary"
                                                size="sm"
                                                isOutline=""
                                                isLinkBtn=''
                                                link="https://#"
                                                onclick=""
                                                />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- from-group end --}}

                        </div>
                    </div>
                    <div class="mt-4">
                        {{-- table  compoent start--}}
                            @php
                            $headers = ['id'=>'id','Address', 'Type', 'Price', 'Availibility'];
                            $rows = [
                                ["id"=>1, '73-79 Balham High Road, London, SW12 9AP', 'Flat', '12500', '13/02/25'],
                                ["id"=>2, '75-90 Balham High Road, London, SW12 9AP', 'Flat', '12500', '13/02/25'],
                            ];
                        @endphp
                        <x-backend.dynamic-table :headers="$headers" :rows="$rows" class='contact_add_property' />
                    </div>
                </div>
                <div class="footer_btn">
                    <div class="row mt-lg-4">
                        <div class="col-6">
                            <button type="button" class="btn btn_outline_secondary previous-step mt-2 w-100" data-previous-step="{{$currentStep-1}}"
                                data-current-step="{{$currentStep}}">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn_secondary btn-sm next-step mt-2 w-100" data-next-step="{{$currentStep+1}}"
                        data-current-step="{{$currentStep}}">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
