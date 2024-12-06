
@props([
   'class'=>'', 
   'inputName'=>null, 
   'inputOpt'=>null,
   'inputType'=>'text',
   'rightIcon'=>null,
   'placeHolder'=>null,
   'isLabel',
   'label'=>null,
   'isDate'=>false,
   'isIcon'=>false,
   'iconName', 'onIconClick'=>''
])


@if($isLabel == True)
<label class="mb-2" for="{{ $inputName }}">{{ $label }}</label>
@endif
<div class='rs_input | {{ $inputOpt }} {{ $isLabel == True ? "with_label" : ""}} {{ $isDate == True? "with_date" : "" }} {{$class}} ' >
   @if ($inputOpt == 'input_price')
      {{ getPoundSymbol() }}
   @endif

   <input type="{{ $inputType }}" name= "{{ $inputName }}" placeholder="{{ $placeHolder}}" />

   @if ($rightIcon)
   <div class="right_icon">{{ $rightIcon }}</div>
   @endif
   @if ($isIcon)
   <div class="right_icon" onClick="{{ $onIconClick }}()"><i class="bi {{ $iconName }}"></i></div>
   @endif
</div>