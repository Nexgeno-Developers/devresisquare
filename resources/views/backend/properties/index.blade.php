@extends('backend.layout.app')

@section('content')

<div class="row">
    <div class="col-lg-5 col-12">
        <div class="pv_wrapper">
            <div class="pv_header">
                <div class="pv_title">Properties</div>
                    <x-backend.search 
                        class=""
                        value=""
                        placeholder="Search"
                        onclick=""
                    />
                    
                <div class="pv_btn">
                    <x-backend.main-button
                        class=""
                        name="Add Property"
                        type="secondary"
                        size="sm"
                        isLinkBtn={{true}}
                        link="{{ route('admin.properties.quick') }}"
                        onclick=""
                    />
                </div>
            </div>
            {{-- pv_header end --}}
            <div class="pv_card_wrapper">
                {{-- Dev Note: if select property from list add class 'current' to property card --}}
                @foreach ($properties as $property)
                <x-backend.property-card
                    class=""
                    propertyName="{{$property['prop_name']}}"
                    bed="{{$property['bedroom']}}"
                    bath="{{$property['bathroom']}}"
                    floor="{{$property['floor']}}"
                    living="{{$property['reception']}}"
                    {{-- living="{{$property['living']}}" --}}
                    type="{{$property['property_type']}}"
                    available="{{$property['available_from']}}"
                    price="{{$property['price']}}"
                />
                @endforeach

            </div>
            {{-- pv_card_wrapper end  --}}
        </div>
        {{-- pv_wrapper end  --}}
    </div>
    <div class="col-lg-7 col-12">
        <div class="pv_detail_wrapper">
            <div class="pv_tabs">
                <ul>
                    <li> <a href="" class="active"> Property </a></li>
                    <li> <a href="" class=""> Owners </a></li>
                    <li> <a href="" class=""> Offers </a></li>
                    <li> <a href="" class=""> Complience </a></li>
                    <li> <a href="" class=""> Tenancy </a></li>
                    <li> <a href="" class=""> APS </a></li>
                    <li> <a href="" class=""> Media </a></li>
                    <li> <a href="" class=""> Teams </a></li>
                    <li> <a href="" class=""> Contractor </a></li>
                    <li> <a href="" class=""> Work Offer </a></li>
                    <li> <a href="" class=""> Note </a></li>
                </ul>
            </div>
            {{-- table  compoent start--}}
            @php 
                $headers = ['id','Name', 'Position', 'Phone', 'email', 'City']; 
                $rows = [ 
                    ['id' => 1, 'name'=> 'John Doe', 'postion'=>'Owner', 'phone'=> '456798462', 'email'=> 'john@example.com', 'city'=> 'London' ], 
                    ['id' => 2, 'name'=> 'Jane Smith', 'postion'=>'Owner', 'phone'=> '974511268', 'email'=> 'jane@example.com', 'city'=> 'Mumbair' ], 
                    ['id' => 3, 'name'=>  'Jack Johnson',  'postion'=>'Landlord','phone'=>  '14563278','email'=> 'jack@example.com', 'city'=> 'Canada' ], 
                ];
            @endphp
            <x-backend.dynamic-table :headers="$headers" :rows="$rows" />
            {{-- table  compoent end--}}
            <div class="pv_detail_content">
                <div class="pv_detail_header">
                    <div class="pv_main_title">Property Detail</div>
                    <div class="pvdh_btns_wrapper">
                        <x-backend.link-button
                            class=""
                            name="Add Tenancy"
                            link="{{ route('admin.properties.quick') }}"
                            onClick=""
                        />
                        <x-backend.link-button
                            class=""
                            name="Add Offer"
                            link="{{ route('admin.properties.quick') }}"
                            onClick=""
                        />


                        <x-backend.outline-link-button 
                            class=""
                            name="Edit Property"
                            link="{{ route('admin.properties.edit', ['id' => $property->id]) }}"
                            onClick=""
                        />
                    </div>
                </div>
                <div class="pv_content_detail">

                    <div class="pvd_content_wrapper">
                        <div class="pv_image">
                            <img src="{{ asset('/asset/images/temp-property.webp') }}" alt="property">
                        </div>
                        <div class="pv_content">
                            <div class="pvc_ref_id">Ref: 1234SSSD</div>
                            <div class="pvc_poperty_name">169-173 Portland Rd, Hove, East Sussex, BN3 5QJ</div>
                            <div class="rs_property_icons">
                                <div class="bed_icon rs_tooltip">
                                    <img src=" {{asset('asset/images/svg/icons/bed.svg')}} " alt="bedroom" > 2
                                </div>
                                <div class="bath_icon rs_tooltip">
                                    <img src=" {{asset('asset/images/svg/icons/bath.svg')}} " alt="bathroom"> 1
                                </div>
                                <div class="floors_icon rs_tooltip">
                                    <img src=" {{asset('asset/images/svg/icons/floor.svg')}} " alt="Floors">2
                                </div>
                                <div class="living_icon rs_tooltip">
                                    <img src=" {{asset('asset/images/svg/icons/sofa.svg')}} " alt="sofa"> 2
                                </div>
                            </div>
                            <div class="pvc_price">
                                Price: <span>£3000</span>
                            </div>
                            <div class="rs_row">
                                <div class="rs_col">
                                    <div class="pv_type">Type: <strong> Apparment</strong></div>
                                </div>
                                <div class="rs_col">
                                    <div class="pv_availability">Availability: <strong>11/02/25</strong></div>
                                </div>
                            </div>
                            {{-- rs_row end  --}}
                            <div class="rs_row">
                                <div class="rs_col">
                                    <div class="pv_status">Status: <strong> For Sale</strong></div>
                                </div>
                                <div class="rs_col">
                                    <div class="pv_service">Service: <strong>Let Only</strong></div>
                                </div>
                            </div>
                            {{-- rs_row end  --}}

                        </div>
                        {{-- pv_content end  --}}
                    </div>
                    {{-- pvd_content_wrapper end --}}
                    <div class="pvd_other_content border_bottom">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="row">
                                    <div class="col-lg-5 col-12 mb-2">Furnished</div>
                                    <div class="col-lg-7 col-12 mb-2">Unfurnished</div>
                                    <div class="col-lg-5 col-12 mb-2">Parking</div>
                                    <div class="col-lg-7 col-12 mb-2">Yes</div>
                                    <div class="col-lg-5 col-12 mb-2">Balcony</div>
                                    <div class="col-lg-7 col-12 mb-2">Yes</div>
                                    <div class="col-lg-5 col-12 mb-2">Garden</div>
                                    <div class="col-lg-7 col-12 mb-2">Yes</div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-2">Collecting Rent</div>
                                    <div class="col-lg-6 col-12 mb-2">Yes</div>
                                    <div class="col-lg-6 col-12 mb-2">Area Sqr. Feet</div>
                                    <div class="col-lg-6 col-12 mb-2">800</div>
                                    <div class="col-lg-6 col-12 mb-2">Area Sqr. Meter</div>
                                    <div class="col-lg-6 col-12 mb-2">20</div>
                                    <div class="col-lg-6 col-12 mb-2">Aspects</div>
                                    <div class="col-lg-6 col-12 mb-2">North</div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- pvd_other_content end --}}
                    <div class="pvd_features">
                        <div class="pv_sub_title mb-4">
                            Features
                        </div>
                        <div class="row features_list_warpper">
                            <div class="col-lg-6">
                                <ul class="features_list">
                                    <li>Frunished</li>
                                    <li>Flexible</li>
                                    <li>Undercounter refrigerator with freezer</li>
                                    <li>Dishwasher</li>
                                    <li>Gas hob</li>
                                    <li>Washing machine</li>
                                    <li>Dryer</li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="features_list">
                                    <li>Window locks</li>
                                    <li>Business Centre</li>
                                    <li>Double glazing</li>
                                    <li>Underfloor heating</li>
                                    <li>Dishwasher</li>
                                    <li>Gas</li>
                                    <li>Central heating</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page.scripts')
<script>

</script>
@endsection
