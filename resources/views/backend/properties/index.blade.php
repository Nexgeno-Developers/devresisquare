@extends('backend.layout.app')

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="pv_wrapper">
            <div class="pv_header">
                <div class="pv_title">Properties</div>
                <div class="pv_search">search</div>
                <div class="pv_btn">
                    <a href="{{ route('admin.properties.quick') }}" class="btn btn-primary btn-sm" >
                        Add Property
                    </a>
                </div>
            </div>
            {{-- pv_header end --}}
            <div class="pv_card_wrapper">
                {{-- @include('backend.components.property-h-card') --}}
                <x-property-card 
                    propertyName="169-173 Portland Rd, Hove, East Sussex, BN3 5QJ"
                    bed="2" 
                    bath="2" 
                    floor="2" 
                    living="2" 
                    type="Apartment" 
                    available="02/08/25" 
                    price="3000"
                />
                <x-property-card 
                    propertyName="264-452 Portland Rd, Hove,  Sussex, BN3 5QJ"
                    bed="3" 
                    bath="2" 
                    floor="6" 
                    living="1" 
                    type="Apartment" 
                    available="02/08/26" 
                    price="2840"
                />

            </div>
            {{-- pv_card_wrapper end  --}}
        </div>
        {{-- pv_wrapper end  --}}
    </div>
    <div class="col-lg-7">
        test
    </div>
</div>
@endsection

@section('page.scripts')
<script>

</script>
@endsection