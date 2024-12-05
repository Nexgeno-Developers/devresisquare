<!-- resources/views/backend/properties/quick_form_components/step4.blade.php -->
@php $currentStep = 3 ; @endphp
<div class="container-fluid mt-4 quick_add_property">
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
            <form id="property-form-step-{{$currentStep}}" method="POST" action="{{ route('admin.properties.quick_store') }}">
                @csrf
                <!-- Hidden field for property ID with isset check -->
                <input type="hidden" id="property_id" class="property_id" name="property_id"
                    value="{{ (isset($property) ? $property->id : '') }}">
                <div data-step-name="Property Address" data-step-number="{{$currentStep}}"></div>
                <div class="steps_wrapper">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="from-group">
                                <label class="mb-2" for="search_property">Search Property</label>
                                <div class="row">
                                    <div class="col">

                                        <div class="rs_input with_label with_icon">
                                            <input type="text" id="search_property" name="search_property" placeholder="Search Property" />
                                            <div class="right_icon">se</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="from-group">
                                            <x-backend.main-button
                                                    class=""
                                                    name="Attach"
                                                    type="secondary"
                                                    size="sm"
                                                    isOutline=""
                                                    isLinkBtn=
                                                    link="https://#"
                                                    onclick=""
                                                    />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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