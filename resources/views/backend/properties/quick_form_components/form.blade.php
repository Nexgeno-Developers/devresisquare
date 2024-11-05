<!-- resources/views/backend/properties/form_components/form.blade.php -->
@extends('backend.layout.app')

@section('content')
@php
    function getBreadcrumb($step)
    {
        $breadcrumb = [
            1 => 'Property name',
            2 => 'Property Address',
            3 => 'Property Type',
            4 => 'Property Information',
            5 => 'Rooms',
            6 => 'Price',
        ];

        return $breadcrumb[$step] ?? 'Unknown Step';
    }
@endphp

<div class="">
    <h4 class="mb-4">Quick Add Property</h4>
    <div class="qap_breadcrumb">
        @for ($i = 1; $i <= 6; $i++)
            <div class="form-check {{ session('current_step') == $i ? 'active' : '' }}">
                <input class="form-check-input" type="radio" name="step" id="step{{ $i }}" value="{{ $i }}" {{ session('current_step') == $i ? 'checked' : '' }}>
                <label class="form-check-label {{ session('current_step') == $i ? 'active' : '' }}"
                    for="step{{ $i }}">
                    {{ getBreadcrumb($i) }}
                </label>
            </div>
        @endfor
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 render_blade">
                @include('backend.properties.quick_form_components.step' . session('current_step', 1))  <!-- Default to step 1 -->
            </div>
        </div>
    </div>
</div>
@endsection
