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
                @include('backend.components.property-h-card')
                @include('backend.components.property-h-card')
                @include('backend.components.property-h-card')
                @include('backend.components.property-h-card')
                @include('backend.components.property-h-card')
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