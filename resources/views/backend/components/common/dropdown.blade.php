@php
    $dropdownId = 'dropdownMenuButton' . uniqid();
@endphp


<div class="dropdown">

    @if($isIcon == false)
        <div class="rs_dropdown dropdown_click  dropdown-toggle {{ $class }}" id="{{ $dropdownId }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select Option
        </div>
    @else
        <div class="rs_icon_dropdown  dropdown_click dropdown-toggle {{ $class }}" id="{{ $dropdownId }}"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
    @endif


    <div class="dropdown-menu {{$isIcon == True ? 'right_icon' : ''}}" aria-labelledby="{{$dropdownId }}">
        @foreach ($options as $option)
            @if (isset($option['url']) && isset($option['label'])) <!-- Check if both 'url' and 'label' are set -->
                <a class="dropdown-item {{ $option['class'] ?? '' }}" href="{{ $option['url'] }}" onclick="{{ $option['onclick'] ?? ''}}">
                    {{ $option['label'] }}
                </a>
            @endif
        @endforeach
    </div>
</div>
