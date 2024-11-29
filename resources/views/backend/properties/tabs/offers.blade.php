{{-- Hidden div for property ID --}}
<div id="hidden-property-id" style="display: none;" data-property-id="{{ $propertyId }}">
    @php
        // Debugging the propertyId
        echo '<pre>';
        var_dump($propertyId);
        echo '</pre>';
    @endphp
</div>
