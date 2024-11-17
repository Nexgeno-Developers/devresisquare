
<div class="pv_content_wrapper">
    <div class="pv_image">
        <img src="{{ asset('/asset/images/temp-property.webp') }}" alt="property">
    </div>
    <div class="pv_content">
        <div class="pvc_poperty_name">169-173 Portland Rd, Hove, East Sussex, BN3 5QJ</div>
        <div class="rs_property_icons">
            <div class="bed_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/bed.svg')}} " alt="bedroom" > 2
            </div>
            <div class="bath_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/bath.svg')}} " alt="bathroom"> 2
            </div>
            <div class="floors_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/floor.svg')}} " alt="Floors"> 2
            </div>
            <div class="living_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/sofa.svg')}} " alt="sofa"> 2
            </div>
        </div>
        <div class="rs_row">
            <div class="rs_col">
                <div class="pv_type">Type: <strong> Apartment</strong></div>
            </div>
            <div class="rs_col">
                <div class="pv_availability">Availability: <strong>02/08/25</strong></div>
            </div>
        </div>
        {{-- rs_row end  --}}
        <div class="pvc_price">
            Price: <span>£3200</span>
        </div>
    </div>
    {{-- pv_content end  --}}
</div>