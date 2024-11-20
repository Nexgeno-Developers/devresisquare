<div class="dropdown">
    @if($isIcon == false)
        <div class="rs_dropdown dropdown_click {{ $class }}" id="dropdownMenuButton" aria-expanded="false" onclick="toggleDropdown()">
            Select Option
        </div>
    @else
        <div class="rs_icon_dropdown dropdown_click {{ $class }}" id="dropdownMenuButton"  aria-expanded="false" onclick="toggleDropdown()"></div>
    @endif
    <div class="dropdown-menu" id="dropdownMenu" aria-labelledby="dropdownMenuButton" style="display: none;">
        @foreach($options as $value => $label)
            <a class="dropdown-item" href="#" onclick="selectOption('{{ $value }}', '{{ $label }}')">{{ $label }}</a>
        @endforeach
    </div>
</div>
<input type="hidden" id="selectedOption" name="selectedOption" value="{{ $selected }}">


<!-- Dropdown script  -->
<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
    }

    function selectOption(value, label) {
        document.getElementById('dropdownMenuButton').innerText = label;
        document.getElementById('selectedOption').value = value;
        document.getElementById('dropdownMenu').style.display = 'none';
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown_click')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }
</script>


