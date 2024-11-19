
    <{{ $isLinkBtn == true ? 'a href="'.$link.'" ' : 'button'}} class="btn btn_{{ $isOutline == true ? 'outline_':'' }}{{ $type }} btn-{{ $size }} {{ $class }}" onClick="{{$onClick}}" >
        {{ $name }}
    </{{ $isLinkBtn == true ? 'a href="'.$link.'"' : 'button'}}>
