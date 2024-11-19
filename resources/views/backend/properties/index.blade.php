@extends('backend.layout.app')

@section('content')

<style>
    .pv_tabs {
    font-family: Arial, sans-serif;
}

.pv_tabs ul {
    display: flex;
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.pv_tabs ul li {
    margin-right: 20px;
}

.pv_tabs ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px;
}

.pv_tabs ul li a.active {
    color: #007bff;
    border-bottom: 2px solid #007bff;
}

.tab-content {
    margin-top: 20px;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

</style>

<div class="row">
    <div class="col-lg-5">
        <div class="pv_wrapper">
            <div class="pv_header">
                <div class="pv_title">Properties</div>
                <div class="pv_search">search</div>
                <div class="pv_btn">
                    <x-backend.link-button
                        class=""
                        name="Add Property"
                        link="{{ route('admin.properties.quick') }}"
                        onClick=""
                    />
                </div>
            </div>
            {{-- pv_header end --}}
            <div class="pv_card_wrapper">
                {{-- Dev Note: if select property from list add class 'current' to property card --}}
                @foreach ($properties as $property)
                <x-backend.property-card
                    class=""
                    propertyName="{{$property['prop_name'].' '.$property['line1'].' '.$property['line2'].' '.$property['city']}}"
                    bed="{{$property['bedroom']}}"
                    bath="{{$property['bathroom']}}"
                    floor="{{$property['floor']}}"
                    living="{{$property['reception']}}"
                    {{-- living="{{$property['living']}}" --}}
                    type="{{$property['property_type']}}"
                    available="{{$property['available_from']}}"
                    price="{{$property['price']}}"
                    propertyId="{{ $property['id'] }}"                    />
                @endforeach

            </div>
            {{-- pv_card_wrapper end  --}}
        </div>
        {{-- pv_wrapper end  --}}
    </div>
    <div class="col-lg-7">
        <div class="pv_detail_wrapper">

            <x-backend.tabs :tabs="[
                ['name' => 'Property', 'content' => 'Property details here...'],
                ['name' => 'Owners', 'content' => 'Owner details here...'],
                ['name' => 'Offers', 'content' => 'Offers details here...'],
                ['name' => 'Complience', 'content' => 'Complience details here...'],
                ['name' => 'Tenancy', 'content' => 'Tenancy details here...'],
                ['name' => 'APS', 'content' => 'APS details here...'],
                ['name' => 'Media', 'content' => 'Media details here...'],
                ['name' => 'Teams', 'content' => 'Team details here...'],
                ['name' => 'Contractor', 'content' => 'Contractor details here...'],
                ['name' => 'Work Offer', 'content' => 'Work Offer details here...'],
                ['name' => 'Note', 'content' => 'Note details here...']
            ]" />
            <div class="pv_detail_content">
                <div class="pv_detail_header">
                    <div class="pv_main_title">{{--$tabname--}} Detail</div>
                    <div class="pvdh_btns_wrapper">
                        <x-backend.link-button class="" name="Add Tenancy" link="{{ route('admin.properties.quick') }}"
                            onClick="" />
                        <x-backend.link-button class="" name="Add Offer" link="{{ route('admin.properties.quick') }}"
                            onClick="" />
                        <x-backend.outline-link-button class="" name="Edit Property"
                            link="{{ route('admin.properties.edit', ['id' => $property->id]) }}" onClick="" />
                    </div>
                </div>
                <div class="pv_content_detail">
                    {{-- render first tabs blade file from view example @include('backend.properties.tabs' . $tabname) $tabname in small case--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page.scripts')
<script>
    document.querySelectorAll('.tab-link').forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove active class from all tabs and tab content
            document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

            // Add active class to the clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(this.getAttribute('href').substring(1)).classList.add('active');
        });
    });
</script>
@endsection

