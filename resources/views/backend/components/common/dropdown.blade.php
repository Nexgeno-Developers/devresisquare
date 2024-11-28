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
            <a class="dropdown-item" href="{{ $option['url'] }}">{{ $option['label'] }}</a>
        @endforeach
    </div>
</div>
