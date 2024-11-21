<div class="flex flex_row gap_16">
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
<div class="pvd_content_wrapper">
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
{{-- pvd_features end --}}
</div>
{{-- pvd_content_wrapper end --}}