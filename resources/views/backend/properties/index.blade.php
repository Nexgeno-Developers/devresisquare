@extends('backend.layout.app')

@section('content')
    <style>
        .pv_tabs {
            font-family: Arial, sans-serif;
        }

        .pv_tabs ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .pv_tabs ul li {
            margin-right: 20px;
        }

        .pv_tabs ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px;
        }

        .pv_tabs ul li a.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }

        .tab-content {
            margin-top: 20px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }
    </style>

    <div class="row">
        <div class="col-lg-5 col-12">
            <div class="pv_wrapper">
                <div class="pv_header">
                    <div class="pv_title">Properties</div>
                    <x-backend.search class="" value="" placeholder="Search" onclick="" />

                    <div class="pv_btn">
                        <x-backend.main-button class="" name="Add Property" type="secondary" size="sm"
                            isLinkBtn={{ true }} link="{{ route('admin.properties.quick') }}" onclick="" />
                    </div>
                </div>
                {{-- pv_header end --}}
                <div class="pv_card_wrapper">
                    {{-- Dev Note: if select property from list add class 'current' to property card --}}
                    @foreach ($properties as $property)
                        <x-backend.property-card class="property-card" propertyName="{{ $property['prop_name'] }}"
                            bed="{{ $property['bedroom'] }}" bath="{{ $property['bathroom'] }}"
                            floor="{{ $property['floor'] }}" living="{{ $property['reception'] }}" {{-- living="{{$property['living']}}" --}}
                            type="{{ $property['property_type'] }}" available="{{ $property['available_from'] }}"
                            price="{{ $property['price'] }}" cardStyle="" propertyId="{{ $property['id'] }}" />
                    @endforeach

                </div>
                {{-- pv_card_wrapper end  --}}
            </div>
            {{-- pv_wrapper end  --}}
        </div>
        <div class="col-lg-7 col-12 p-0">
            <div class="pv_detail_wrapper">

                <x-backend.properties-tabs :tabs="$tabs" />
                {{-- <x-backend.properties-tabs :tabs="[
                ['name' => 'Property', 'content' => 'Property details here...'],
                ['name' => 'Owners', 'content' => 'Owner details here...'],
                ['name' => 'Offers', 'content' => 'Offers details here...'],
                ['name' => 'Complience', 'content' => 'Complience details here...'],
                ['name' => 'Tenancy', 'content' => 'Tenancy details here...'],
                ['name' => 'APS', 'content' => 'APS details here...'],
                ['name' => 'Media', 'content' => 'Media details here...'],
                ['name' => 'Teams', 'content' => 'Team details here...'],
                ['name' => 'Contractor', 'content' => 'Contractor details here...'],
                ['name' => 'Work Offer', 'content' => 'Work Offer details here...'],
                ['name' => 'Note', 'content' => 'Note details here...']
            ]" /> --}}
                <div class="pv_detail_content">
                    <div class="pv_detail_header">
                        <div class="pv_main_title">{{ $tabName }} Detail</div>
                        <div class="pvdh_btns_wrapper">
                            <x-backend.link-button class="" name="Add Tenancy"
                                link="{{ route('admin.properties.quick') }}" onClick="" />
                            <x-backend.link-button class="" name="Add Offer"
                                link="{{ route('admin.properties.quick') }}" onClick="" />
                            <x-backend.outline-link-button class="" name="Edit Property"
                                link="{{ route('admin.properties.edit', ['id' => $property->id]) }}" onClick="" />
                        </div>
                    </div>
                    <div class="pv_content_detail">
                        {!! $content !!}
                        <!-- The dynamic tab content will be injected here by AJAX -->
                        {{-- render first tabs blade file from view example @include('backend.properties.tabs' . $tabname) $tabname in small case --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page.scripts')
    <script>
        // document.querySelectorAll('.tab-link').forEach(tab => {
        //     tab.addEventListener('click', function(event) {
        //         event.preventDefault();

        //         // Remove active class from all tabs and tab content
        //         document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
        //         document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

        //         // Add active class to the clicked tab and corresponding content
        //         this.classList.add('active');
        //         document.getElementById(this.getAttribute('href').substring(1)).classList.add('active');
        //     });
        // });
        $(document).ready(function() {
    // Handle Tab Clicks
    // Click event for property cards (left side)
    $(document).on('click', '.property-card', function() {
        // Get the property ID from the clicked property card
        var propertyId = $(this).data('property-id'); // Ensure 'data-property-id' exists on the property card

        // Mark the clicked property card as 'current' and remove the 'current' class from others
        $('.property-card').removeClass('current');
        $(this).addClass('current');

        // Get the active tab's name (right side)
        var tabName = $('.tab-link.active').data('tab-name'); // Ensure 'data-tab-name' exists on the tab link
        console.log('clicked property card');

        // Call the function to load the content dynamically
        loadTabContent(propertyId, tabName);
    });

    // Click event for tabs (right side)
    $(document).on('click', '.tab-link', function(e) {
        e.preventDefault(); // Prevent default link behavior

        // Get the tab name from the clicked tab
        var tabName = $(this).data('tab-name'); // Ensure 'data-tab-name' exists on the tab link

        // Get the property ID from the currently selected property card (left side)
        var propertyId = $('.property-card.current').data('property-id'); // Ensure 'data-property-id' exists on the property card

        // Mark the clicked tab as 'active' and remove the 'active' class from others
        $('.tab-link').removeClass('active');
        $(this).addClass('active');
        console.log('clicked tab');

        // Call the function to load the content dynamically
        loadTabContent(propertyId, tabName);
    });

    // Check if URL parameters are present (property_id and tabname)
    function hasUrlParams() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.has('property_id') && urlParams.has('tabname');
    }

    // Simulate the first tab and first property card selection on page load
    function simulateTabClickAndPropertyCard() {
        var firstPropertyCard = $('.property-card').first(); // Get the first property card
        var firstTab = $('.tab-link').first(); // Get the first tab

        // Get the propertyId and tabName from the first property card and tab
        var propertyId = firstPropertyCard.data('property-id');
        var tabName = firstTab.data('tab-name');
        console.log(propertyId);
        console.log(tabName);

        // Trigger the AJAX load
        if (propertyId && tabName) {
            loadTabContent(propertyId, tabName);
            firstPropertyCard.addClass('current'); // Add 'current' class to the first property card
            firstTab.addClass('active'); // Add 'active' class to the first tab
        }
    }

    // Call the simulateTabClickAndPropertyCard function on document ready only if URL parameters are NOT present
    if (!hasUrlParams()) {
        simulateTabClickAndPropertyCard();
    }

    // Function to load tab content dynamically via AJAX
    function loadTabContent(propertyId, tabName) {
        // Correctly format the URL with query parameters instead of placeholders
        var url = '{{ route('admin.properties.index') }}' + '?property_id=' + propertyId + '&tabname=' + tabName;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update the content of the tab with the response
                // You might want to populate the content into a specific div
                // Example: $('.pv_content_detail').html(response.content);
                $('.pv_content_detail').html(response.content);

                // Update URL (optional, for browser navigation)
                window.history.pushState(null, null, url);
            },
            error: function(xhr, status, error) {
                console.error('Error loading tab content:', error);
            }
        });
    }
});


        // $(document).ready(function() {
        //     // Function to load tab content dynamically via AJAX
        //     function loadTabContent(propertyId, tabName) {
        //         // Get the URL dynamically using Blade's route helper
        //         var url =
        //             '{{-- route('admin.properties.tabcontent', ['property_id' => ':property_id', 'tabname' => ':tabname']) --}}';
        //         url = url.replace(':property_id', propertyId).replace(':tabname', tabName); // Replace placeholders

        //         // Send the AJAX request
        //         $.ajax({
        //             url: url, // The URL to send the request to
        //             type: 'GET', // Use GET request to fetch content
        //             dataType: 'json', // Expect HTML response
        //             success: function(response) {
        //                 // Inject the response HTML into the tab content area
        //                 $('.pv_content_detail').html(response.content);
        //                 // Update the URL to reflect the selected property and tab (without reloading)
        //                 window.history.pushState(null, null, url);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error loading tab content:', error);
        //                 // Optionally, handle the error by showing a message or fallback content
        //             }
        //         });
        //     }

        //     // Click event for property cards (left side)
        //     $(document).on('click', '.property-card', function() {
        //         // Get the property ID from the clicked property card
        //         var propertyId = $(this).data(
        //         'property-id'); // Ensure 'data-property-id' exists on the property card

        //         // Mark the clicked property card as 'current' and remove the 'current' class from others
        //         $('.property-card').removeClass('current');
        //         $(this).addClass('current');

        //         // Get the active tab's name (right side)
        //         var tabName = $('.tab-link.active').data(
        //         'tab-name'); // Ensure 'data-tab-name' exists on the tab link
        //         console.log('clicked property card');
        //         // Call the function to load the content dynamically
        //         loadTabContent(propertyId, tabName);
        //     });

        //     // Click event for tabs (right side)
        //     $(document).on('click', '.tab-link', function(e) {
        //         e.preventDefault(); // Prevent default link behavior

        //         // Get the tab name from the clicked tab
        //         var tabName = $(this).data('tab-name'); // Ensure 'data-tab-name' exists on the tab link

        //         // Get the property ID from the currently selected property card (left side)
        //         var propertyId = $('.property-card.current').data(
        //         'property-id'); // Ensure 'data-property-id' exists on the property card

        //         // Mark the clicked tab as 'active' and remove the 'active' class from others
        //         $('.tab-link').removeClass('active');
        //         $(this).addClass('active');
        //         console.log('clicked tab');
        //         // Call the function to load the content dynamically
        //         loadTabContent(propertyId, tabName);
        //     });

        //     // Simulate the first tab and first property card selection on page load
        //     function simulateTabClickAndPropertyCard() {
        //         var firstPropertyCard = $('.property-card').first(); // Get the first property card
        //         var firstTab = $('.tab-link').first(); // Get the first tab

        //         // Get the propertyId and tabName from the first property card and tab
        //         var propertyId = firstPropertyCard.data('property-id');
        //         var tabName = firstTab.data('tab-name');
        //         console.log(propertyId);
        //         console.log(tabName);
        //         // Trigger the AJAX load
        //         if (propertyId && tabName) {
        //             loadTabContent(propertyId, tabName);
        //             firstPropertyCard.addClass('current'); // Add 'current' class to the first property card
        //             firstTab.addClass('active'); // Add 'active' class to the first tab
        //         }
        //     }

        //     // Call the simulateTabClickAndPropertyCard function on document ready
        //     simulateTabClickAndPropertyCard();
        // });

        // $(document).ready(function() {
        //     // Function to load tab content dynamically via AJAX
        //     function loadTabContent(propertyId, tabName) {
        //         // Get the URL dynamically using Blade's route helper
        //         var url = '{{-- route('admin.properties.tabcontent', ['property_id' => ':property_id', 'tabname' => ':tabname']) --}}';
        //         url = url.replace(':property_id', propertyId).replace(':tabname', tabName); // Replace placeholders

        //         // Send the AJAX request
        //         $.ajax({
        //             url: url,  // The URL to send the request to
        //             type: 'GET',  // Use GET request to fetch content
        //             dataType: 'html',  // Expect HTML response
        //             success: function(response) {
        //                 // Inject the response HTML into the tab content area
        //                 $('.pv_content_detail').html(response);
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error loading tab content:', error);
        //                 // Optionally, handle the error by showing a message or fallback content
        //             }
        //         });
        //     }

        //     // Click event for property cards (left side)
        //     $(document).on('click', '.property-card', function() {
        //         // Get the property ID from the clicked property card
        //         var propertyId = $(this).data('property-id');  // Ensure 'data-property-id' exists on the property card

        //         // Mark the clicked property card as 'current' and remove the 'current' class from others
        //         $('.property-card').removeClass('current');
        //         $(this).addClass('current');

        //         // Get the active tab's name (right side)
        //         var tabName = $('.tab-link.active').data('tab-name');  // Ensure 'data-tab-name' exists on the tab link

        //         // Call the function to load the content dynamically
        //         loadTabContent(propertyId, tabName);
        //     });

        //     // Click event for tabs (right side)
        //     $(document).on('click', '.tab-link', function(e) {
        //         e.preventDefault();  // Prevent default link behavior

        //         // Get the tab name from the clicked tab
        //         var tabName = $(this).data('tab-name');  // Ensure 'data-tab-name' exists on the tab link

        //         // Get the property ID from the currently selected property card (left side)
        //         var propertyId = $('.property-card.current').data('property-id');  // Ensure 'data-property-id' exists on the property card

        //         // Mark the clicked tab as 'active' and remove the 'active' class from others
        //         $('.tab-link').removeClass('active');
        //         $(this).addClass('active');

        //         // Call the function to load the content dynamically
        //         loadTabContent(propertyId, tabName);
        //     });

        //     // Simulate the first tab and first property card selection on page load
        //     function simulateTabClickAndPropertyCard() {
        //         var firstPropertyCard = $('.property-card').first();  // Get the first property card
        //         var firstTab = $('.tab-link').first();  // Get the first tab

        //         // Get the propertyId and tabName from the first property card and tab
        //         var propertyId = firstPropertyCard.data('property-id');
        //         var tabName = firstTab.data('tab-name');
        //         console.log(propertyId);
        //         console.log(tabName);
        //         // Trigger the AJAX load
        //         if (propertyId && tabName) {
        //             loadTabContent(propertyId, tabName);
        //             firstPropertyCard.addClass('current');  // Add 'current' class to the first property card
        //             firstTab.addClass('active');  // Add 'active' class to the first tab
        //         }
        //     }

        //     // Call the simulateTabClickAndPropertyCard function on document ready
        //     simulateTabClickAndPropertyCard();
        // });
    </script>
@endsection
