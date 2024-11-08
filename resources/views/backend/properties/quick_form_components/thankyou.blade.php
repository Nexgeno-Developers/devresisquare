<!-- resources/views/backend/properties/form_components/thankyou.blade.php -->
@extends('backend.layout.app')

@section('content')
<div class="container">
    <div class="container-fluid mt-4 quick_add_property">
        <div class="row">
            <div class="col thanks_page">
                <div class="left_content_wrapper">
                    <div class="left_title">
                        Thanks, <span class="secondary-color">Your property</span><br /> added <span
                            class="secondary-color">successfully!</span>
                    </div>
                    <div class="thanks_img">
                        <img src="{{ asset('asset/images/thanks.png') }}" alt="thanks">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection