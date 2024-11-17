
<div class="pv_content_wrapper {{$class}}">
    <div class="pv_image">
        <img src="{{ asset('/asset/images/temp-property.webp') }}" alt="property">
    </div>
    <div class="pv_content">
        <div class="pvc_poperty_name">{{ $propertyName }}</div>
        <div class="rs_property_icons">
            <div class="bed_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/bed.svg')}} " alt="bedroom" > {{ $bed }}
            </div>
            <div class="bath_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/bath.svg')}} " alt="bathroom"> {{ $bath }}
            </div>
            <div class="floors_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/floor.svg')}} " alt="Floors"> {{ $floor }}
            </div>
            <div class="living_icon rs_tooltip">
                <img src=" {{asset('asset/images/svg/icons/sofa.svg')}} " alt="sofa"> {{ $living }}
            </div>
        </div>
        <div class="rs_row">
            <div class="rs_col">
                <div class="pv_type">Type: <strong> {{ $type }}</strong></div>
            </div>
            <div class="rs_col">
                <div class="pv_availability">Availability: <strong>{{ $available }}</strong></div>
            </div>
        </div>
        {{-- rs_row end  --}}
        <div class="pvc_price">
            Price: <span>£{{ $price }}</span>
        </div>
    </div>
    {{-- pv_content end  --}}
</div>