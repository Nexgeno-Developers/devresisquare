@extends('backend.layout.app')

@section('content')
    <div class="row view_properties">
        <div class="col-lg-5 col-12 property_list_wrapper pt-lg-4 pt-2 ">
            <div class="pv_wrapper">
                <div class="pv_header">
                    <div class="pv_title">Properties</div>
                    {{-- <x-backend.search-comp class="" value="" placeholder="Search" onclick="" /> --}}
                    <x-backend.forms.search
                        class=''
                        placeholder='Search'
                        value=''
                        onClick='onClick()'
                    />
                    <div class="pv_btn">
                        <x-backend.forms.button
                            class=''
                            name='Add Property'
                            type='secondary'
                            size='sm'
                            isOutline={{false}}
                            isLinkBtn={{true}}
                            link="{{ route('admin.properties.quick') }}"
                            onClick='onClick()'
                        />
                    </div>
                </div>
                {{-- pv_header end --}}
                <div class="pv_card_wrapper">
                    {{-- Dev Note: if select property from list add class 'current' to property card --}}
                    @foreach ($properties as $property)
                        <x-backend.property-card class="property-card" propertyName="{{ $property['prop_name'] }}{{$property['line_1'] ? ', ' : ''}}{{ $property['line_1'] }}{{$property['line_2'] ? ', ' : ''}}{{ $property['line_2'] }}{{$property['city'] ? ', ' : ''}}{{$property['city']}}"
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
        <div class="col-lg-7 col-12 property_detail_wrapper hide_this pt-lg-4 pt-0">
            <div class="pv_detail_wrapper">

                <x-backend.properties-tabs :tabs="$tabs" class="poperty_tabs" />

                <div class="pv_detail_content">
                    <div class="pv_detail_header">
                        <div class="pv_main_title">{{ ucfirst($tabName) }} Detail</div>
                        <div class="pvdh_btns_wrapper">
                            {{-- <x-backend.link-button class="tab-owners-btn popup-tab-owners-create d-none" name="Add Owner"
                                link="{{ route('admin.owner-groups.create') }}" onClick="" /> --}}
                                {{-- <x-backend.forms.button
                                class="tab-owners-btn d-none"
                                name="Add Owner"
                                type="secondary"
                                size="sm"
                                isOutline={{false}}
                                isLinkBtn={{true}}
                                link="{{ route('admin.owner-groups.create') }}"
                                onclick=""
                                /> --}}
                            {{-- <x-backend.link-button class="tab-offers-btn popup-tab-offer-create d-none" name="Add Offer"
                                link="{{ route('admin.properties.quick') }}" onClick="" /> --}}
                                {{-- <x-backend.forms.button
                                    class="tab-offers-btn d-none"
                                    name="Add Offer"
                                    type="secondary"
                                    size="sm"
                                    isOutline={{false}}
                                    isLinkBtn={{true}}
                                    link="#"
                                    onclick=""
                                    /> --}}

                                    <!-- Modal Trigger Button -->
                                    <a type="button" class="tab-offers-btn btn btn_secondary btn-sm d-none" data-bs-toggle="modal" data-bs-target="#addOfferModal">
                                        Add Offer
                                    </a>

                                    <a href="javascript:void(0);"
                                    class="popup-tab-owners-create btn btn_secondary btn-sm tab-owners-btn d-none"
                                    onclick="smallModal('{{ route('admin.owner-groups.create') }}', 'Add Owner')"
                                    role="button"
                                    aria-label="Add Owner">
                                     <span>Add Owner</span>
                                     <span class="icon_btn"></span>
                                 </a>


                            {{-- @if (isset($property) && isset($propertyId)) --}}
                                {{-- <x-backend.outline-link-button class="" name="Edit Property"
                                    link="{{ route('admin.properties.edit', ['id' => $property->id]) }}" onClick="" /> --}}
                                    <x-backend.forms.button
                                    class="edit-property-btn d-none"
                                    name="Edit Property"
                                    type="secondary"
                                    size="sm"
                                    isOutline={{false}}
                                    isLinkBtn={{true}}
                                    {{-- link="{{ route('admin.properties.edit', ['id' => $propertyId]) }}" --}}
                                    link="#"
                                    onclick=""
                                    />
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="pv_content_detail_wrapper">
                        <i class="bi bi-chevron-left" id="backBtn"></i>
                        <div class="pv_content_detail">
                            {!! $content !!}
                            <!-- The dynamic tab content will be injected here by AJAX -->
                            {{-- render first tabs blade file from view example @include('backend.properties.tabs' . $tabname) $tabname in small case --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile_footer mobile_only">
                <div class="pvdh_btns_wrapper">
                    <x-backend.forms.mobile_button
                        class=''
                        name='Add Tenacy'
                        link="{{ route('admin.properties.quick') }}"
                        iconName='file-plus'
                    />
                    <x-backend.forms.mobile_button
                        class=''
                        name='Add Offer'
                        link="{{ route('admin.properties.quick') }}"
                        iconName='file-text'
                    />
                    <x-backend.forms.mobile_button
                        class=''
                        name='Edit Property'
                        link="{{ route('admin.properties.edit', ['id' => $property->id]) }}"
                        iconName='pencil-square'
                    />
                </div>
            </div>
        </div>
    </div>
    <style>
        .hidden {
            display: none;
        }
        .modal-content {
            max-width: 900px;
            margin: auto;
        }
        .add-tenant-btn {
            color: #ff4500;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>

<!-- Modal -->
<div class="modal fade" id="addOfferModal" tabindex="-1" aria-labelledby="addOfferModal-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addOfferModal-label">Add Offer</h5>
          <a type="button" class="btn-close" onclick="closeModel();" data-bs-dismiss="modal" aria-label="Close"></a>
        </div>
        <div class="modal-body">
            <!-- Main Form -->
            <form class="tenantOfferForm" id="tenantOfferForm">
                <!-- Steps Container -->
                <div id="steps-container">
                    <!-- Tenant Forms -->
                    <div id="tenant-forms" class="step"></div>

                    <!-- Offer Details Step -->
                    <div id="offer-step" class="step hidden">
                        <h6>Offer Details</h6>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                        </div>
                        <div class="mb-3">
                            <label for="deposit" class="form-label">Deposit</label>
                            <input type="number" class="form-control" id="deposit" name="deposit" placeholder="Enter deposit amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="term" class="form-label">Term</label>
                            <input type="text" class="form-control" id="term" name="term" placeholder="Enter term" required>
                        </div>
                        <div class="mb-3">
                            <label for="moveInDate" class="form-label">Move-in Date</label>
                            <input type="date" class="form-control" id="moveInDate" name="moveInDate" required>
                        </div>
                    </div>
                </div>
            </form>
            <span id="addTenantButton" class="add-tenant-btn hidden" onclick="addTenant()">Add More Tenant</span>
        </div>
        <!-- Modal Footer Navigation -->
        <div class="modal-footer">
            <button type="button" class="btn btn_outline_secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button id="backButton" type="button" class="btn btn_secondary btn-md hidden">Back</button>
            <button id="nextButton" type="button" class="btn btn_secondary btn-md ">Next</button>
            <button id="submitButton" type="submit" form="tenantOfferForm" class="btn btn-success btn-md hidden">Submit</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Include the Modal Component -->
    @include('backend.components.modal')
@endsection

@section('page.scripts')
<script>
    let currentStep = 1; // Active step
    let tenantForms = [{ id: 1 }]; // Initial tenant
    let nextTenantId = 2;  // Counter to generate new tenant IDs
    const tenantFormsContainer = document.getElementById('tenant-forms');
    const backButton = document.getElementById('backButton');
    const nextButton = document.getElementById('nextButton');
    const addTenantButton = document.getElementById('addTenantButton');
    const submitButton = document.getElementById('submitButton');
    const offerStep = document.getElementById('offer-step');

    // Function to save tenant form data
    function saveTenantFormData() {
        tenantForms.forEach((tenant, index) => {
            const tenantForm = document.querySelector(`.tenant-form[data-step='${index + 1}']`);
            if (tenantForm) {
                tenant.name = document.getElementById(`tenantName_${tenant.id}`).value || '';
                tenant.phone = document.getElementById(`tenantPhone_${tenant.id}`).value || '';
                tenant.email = document.getElementById(`tenantEmail_${tenant.id}`).value || '';
                tenant.employmentStatus = document.getElementById(`employmentStatus_${tenant.id}`).value || '';
                tenant.businessName = document.getElementById(`businessName_${tenant.id}`).value || '';
                tenant.guarantee = document.getElementById(`guarantee_${tenant.id}`).value || '';
                tenant.previouslyRented = document.getElementById(`previouslyRented_${tenant.id}`).value || '';
                tenant.poorCredit = document.getElementById(`poorCredit_${tenant.id}`).value || '';
            }
        });
    }

    // Function to render tenant forms dynamically
    function renderTenantForms() {
        saveTenantFormData(); // Save current form data before rendering
        tenantFormsContainer.innerHTML = '';

        tenantForms.forEach((tenant, index) => {
            const tenantForm = document.createElement('div');
            tenantForm.className = `tenant-form step ${currentStep === index + 1 ? '' : 'hidden'}`;
            tenantForm.setAttribute('data-step', index + 1);
            tenantForm.innerHTML = `
                <h6 class="mb-3">Tenant ${index + 1} Detail</h6>
                <div class="row g-3 tenant-section">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenantName_${tenant.id}" class="form-label">Tenant Name</label>
                            <input type="text" class="form-control" id="tenantName_${tenant.id}"
                                name="tenantName_${tenant.id}" placeholder="Tenant Name" value="${tenant.name || ''}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenantPhone_${tenant.id}" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="tenantPhone_${tenant.id}"
                                name="tenantPhone_${tenant.id}" placeholder="1234567890" value="${tenant.phone || ''}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenantEmail_${tenant.id}" class="form-label">Email</label>
                            <input type="email" class="form-control" id="tenantEmail_${tenant.id}"
                                name="tenantEmail_${tenant.id}" placeholder="tenant.email@gmail.com" value="${tenant.email || ''}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employmentStatus_${tenant.id}" class="form-label">Employment Status</label>
                            <select class="form-select" id="employmentStatus_${tenant.id}"
                                name="employmentStatus_${tenant.id}" required>
                                <option disabled ${!tenant.employmentStatus ? 'selected' : ''}>Choose...</option>
                                <option ${tenant.employmentStatus === 'Self Employed' ? 'selected' : ''}>Self Employed</option>
                                <option ${tenant.employmentStatus === 'Employed' ? 'selected' : ''}>Employed</option>
                                <option ${tenant.employmentStatus === 'Unemployed' ? 'selected' : ''}>Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="businessName_${tenant.id}" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="businessName_${tenant.id}"
                                name="businessName_${tenant.id}" placeholder="Rainbow Ltd." value="${tenant.businessName || ''}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guarantee_${tenant.id}" class="form-label">Guarantee Required</label>
                            <select class="form-select" id="guarantee_${tenant.id}"
                                name="guarantee_${tenant.id}" required>
                                <option ${tenant.guarantee === 'No' ? 'selected' : ''}>No</option>
                                <option ${tenant.guarantee === 'Yes' ? 'selected' : ''}>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="previouslyRented_${tenant.id}" class="form-label">Previously Rented</label>
                            <select class="form-select" id="previouslyRented_${tenant.id}"
                                name="previouslyRented_${tenant.id}" required>
                                <option ${tenant.previouslyRented === 'No' ? 'selected' : ''}>No</option>
                                <option ${tenant.previouslyRented === 'Yes' ? 'selected' : ''}>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="poorCredit_${tenant.id}" class="form-label">Poor Credit History</label>
                            <select class="form-select" id="poorCredit_${tenant.id}"
                                name="poorCredit_${tenant.id}" required>
                                <option ${tenant.poorCredit === 'No' ? 'selected' : ''}>No</option>
                                <option ${tenant.poorCredit === 'Yes' ? 'selected' : ''}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                ${index > 0 ? `<button type="button" class="btn btn-danger btn-sm mt-3" onclick="deleteTenant(${index})">Delete</button>` : ''}
            `;
            tenantFormsContainer.appendChild(tenantForm);
        });
    }

    // Navigation Logic
    function updateStep() {
        const totalSteps = tenantForms.length + 1;
        backButton.classList.toggle('hidden', currentStep === 1);
        nextButton.classList.toggle('hidden', currentStep === totalSteps);
        addTenantButton.classList.toggle('hidden', currentStep !== tenantForms.length);
        submitButton.classList.toggle('hidden', currentStep !== totalSteps);
        offerStep.classList.toggle('hidden', currentStep !== totalSteps);

        document.querySelectorAll('.tenant-form').forEach((form, index) => {
            form.classList.toggle('hidden', currentStep !== index + 1);
        });
    }

    // Validate the current tenant form
    function validateTenantForm() {
        const currentForm = document.querySelector(`.tenant-form[data-step='${currentStep}']`);
        const inputs = currentForm.querySelectorAll('input, select');
        for (const input of inputs) {
            if (!input.checkValidity()) {
                input.focus();
                return false;
            }
        }
        return true;
    }

    // Add Tenant
    function addTenant() {
        if (!validateTenantForm()) {
            initValidate('.tenantOfferForm');
            // alert("Please fill out all required fields for the current tenant.");
            return;
        }
        saveTenantFormData();
        // tenantForms.push({ id: Date.now() });

        // Add a new tenant with a proper ID
        tenantForms.push({ id: nextTenantId });
        nextTenantId++;  // Increment the tenant ID counter
        currentStep = tenantForms.length;
        renderTenantForms();
        updateStep();
    }

    // Delete Tenant
    function deleteTenant(index) {
        tenantForms.splice(index, 1);
        if (currentStep > tenantForms.length) currentStep--;
        renderTenantForms();
        updateStep();
    }

    // Event Listeners
    nextButton.addEventListener('click', () => {
        if (validateTenantForm()) {
            saveTenantFormData();
            if (currentStep <= tenantForms.length) currentStep++;
            updateStep();
        } else {
            initValidate('.tenantOfferForm');
            // alert("Please fill out all required fields for the current tenant.");
        }
    });

    backButton.addEventListener('click', () => {
        saveTenantFormData();
        if (currentStep > 1) currentStep--;
        updateStep();
    });

    submitButton.addEventListener('click', (e) => {
        e.preventDefault();
        saveTenantFormData();
        const formData = new FormData(document.getElementById('tenantOfferForm'));
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        alert('Form Submitted Successfully!');
    });

    // Initialize
    renderTenantForms();
    updateStep();
</script>
    <script>
        var responseHandler = function(response) {
            location.reload();
        }
        $(document).ready(function() {

            // Function to check if the device is mobile
            function is_mobile() {
                return (
                    /Mobi|Android/i.test(navigator.userAgent) || $(window).width() < 768
                );
            }

            if (is_mobile()) {
                $(document).on('click', '.property-card', function() {
                    $('#backBtn').addClass('property_bk_btn_show');
                    $('.property_detail_wrapper').removeClass('hide_this');
                    $('.property_list_wrapper').toggleClass('hide_this'); // Hide left column
                    $('.property_detail_wrapper').addClass('show_this'); // Show right column
                });

                $(document).on('click', '#backBtn', function() {
                    $('#backBtn').removeClass('property_bk_btn_show');
                    $('.property_detail_wrapper').addClass('hide_this');
                    $('.property_detail_wrapper').toggleClass('show_this'); // Hide right column
                    $('.property_list_wrapper').toggleClass('hide_this'); // Show left column
                });
            }

            // Trigger the modal when an element with the 'popup-tab-owners-create' class is clicked
            $(document).on('click', '.popup-tab-owners-create', function(e) {
                e.preventDefault(); // Prevent the default action (e.g., following the link)

                // Get the URL from the link (you can dynamically get the URL as needed)
                var url = $(this).attr('href'); // Assuming you're passing the URL in the 'href' attribute
                var header = 'Add Owner'; // You can set a custom header or get it dynamically
                // Access the data-property-id using JavaScript
                var propertyId = document.getElementById('hidden-property-id').getAttribute(
                    'data-property-id') ?? '';

                smallModal(url, header);
                // Ensure the modal content is loaded and then set the property_id in the hidden input field inside the modal form
                $('#smallModal').on('shown.bs.modal', function() {
                    // Set the property_id in the hidden input field inside the modal form
                    $("input[name='property_id']").val(propertyId);
                });
            });

            // Trigger the modal when an element with the 'popup-tab-offer-create' class is clicked
            $(document).on('click', '.popup-tab-offer-create', function(e) {
                e.preventDefault(); // Prevent the default action (e.g., following the link)

                // Get the URL from the link (you can dynamically get the URL as needed)
                var url = $(this).attr('href'); // Assuming you're passing the URL in the 'href' attribute
                var header = 'Add Offer'; // You can set a custom header or get it dynamically
                // Access the data-property-id using JavaScript
                var propertyId = document.getElementById('hidden-property-id').getAttribute(
                    'data-property-id') ?? '';

                smallModal(url, header);
                // Ensure the modal content is loaded and then set the property_id in the hidden input field inside the modal form
                $('#smallModal').on('shown.bs.modal', function() {
                    // Set the property_id in the hidden input field inside the modal form
                    $("input[name='property_id']").val(propertyId);
                });
            });

            // Trigger the modal when an element with the 'popup-tab-owners-edit' class is clicked
            $(document).on('click', '.popup-tab-owners-edit', function(e) {
                e.preventDefault(); // Prevent the default action (e.g., following the link)

                // Get the URL from the link (you can dynamically get the URL as needed)
                var url = $(this).attr('href'); // Assuming you're passing the URL in the 'href' attribute
                var header = 'Edit Owner'; // You can set a custom header or get it dynamically
                // Access the data-property-id using JavaScript
                var propertyId = document.getElementById('hidden-property-id').getAttribute(
                    'data-property-id') ?? '';

                smallModal(url, header);
                // Ensure the modal content is loaded and then set the property_id in the hidden input field inside the modal form
                $('#smallModal').on('shown.bs.modal', function() {
                    // Set the property_id in the hidden input field inside the modal form
                    $("input[name='property_id']").val(propertyId);
                });
            });
            $(document).on('click', '.popup-tab-owners-create', function(e) {
                e.preventDefault(); // Prevent the default action (e.g., following the link)

                // Get the URL from the link (you can dynamically get the URL as needed)
                var url = $(this).attr('href'); // Assuming you're passing the URL in the 'href' attribute
                var header = 'Create Owner'; // You can set a custom header or get it dynamically
                // Access the data-property-id using JavaScript
                var propertyId = document.getElementById('hidden-property-id').getAttribute(
                    'data-property-id') ?? '';

                smallModal(url, header);
                // Ensure the modal content is loaded and then set the property_id in the hidden input field inside the modal form
                $('#smallModal').on('shown.bs.modal', function() {
                    // Set the property_id in the hidden input field inside the modal form
                    $("input[name='property_id']").val(propertyId);
                });
            });
        });

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

            // Function to get URL parameters
            function getUrlParameter(name) {
                var urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }

            // Check if URL parameters are present (property_id and tabname)
            function hasUrlParams() {
                var urlParams = new URLSearchParams(window.location.search);
                return urlParams.has('property_id') && urlParams.has('tabname');
            }

            // Function to update the title dynamically
            function updateTitle(tabName, propertyId = null) {
                // Capitalize the first letter of the tab name for display
                var formattedTitle = tabName.charAt(0).toUpperCase() + tabName.slice(1);

                // Update the content of the title div
                $('.pv_main_title').text(formattedTitle + ' Detail');

                // Show or hide the button based on the tabName
                if (tabName === 'owners') {
                    $('.tab-owners-btn').removeClass('d-none'); // Show the button for 'owner' tab
                } else {
                    $('.tab-owners-btn').addClass('d-none'); // Hide the button for other tabs
                }
                if (tabName === 'offers') {
                    $('.tab-offers-btn').removeClass('d-none'); // Show the button for 'owner' tab
                } else {
                    $('.tab-offers-btn').addClass('d-none'); // Hide the button for other tabs
                }
                   // Update the "Edit Property" button dynamically if property ID exists
                if (propertyId) {
                    var editButtonLink = '{{ route('admin.properties.edit', ['id' => ':id']) }}'.replace(':id', propertyId);
                    $('.pvdh_btns_wrapper .edit-property-btn').removeClass('d-none').attr('href', editButtonLink);
                        // console.log(editButtonLink);
                } else {
                    $('.pvdh_btns_wrapper .edit-property-btn').addClass('d-none'); // Hide the button if no property ID
                }

            }

            // Handle Tab Clicks
            // Event listener for property cards (left side)
            $(document).on('click', '.property-card', function() {
                var propertyId = $(this).data('property-id');
                $('.property-card').removeClass('current');
                $(this).addClass('current');
                var tabName = $('.tab-link.active').data('tab-name');
                loadTabContent(propertyId, tabName);
            });

            // Event listener for tabs (right side)
            $(document).on('click', '.tab-link', function(e) {
                e.preventDefault();
                var tabName = $(this).data('tab-name');
                var propertyId = $('.property-card.current').data('property-id');
                $('.tab-link').removeClass('active');
                $(this).addClass('active');
                loadTabContent(propertyId, tabName); // Load content dynamically
            });

            // Check if URL parameters are present (property_id and tabname)
            function hasUrlParams() {
                var urlParams = new URLSearchParams(window.location.search);
                return urlParams.has('property_id') && urlParams.has('tabname');
            }
            // Call the appropriate function based on URL parameters or default
            if (hasUrlParams()) {
                activateTabFromUrl(); // Handle tabs based on URL parameters
            } else {
                simulateTabClickAndPropertyCard(); // Default behavior
            }


            // Function to activate tab based on URL parameter
            function activateTabFromUrl() {
                var tabName = getUrlParameter('tabname'); // Get tabname from URL
                var propertyId = getUrlParameter('property_id'); // Get property_id from URL

                if (tabName && propertyId) {
                    // Find the tab and property card with the matching data attributes
                    var selectedTab = $('.tab-link[data-tab-name="' + tabName + '"]');
                    var selectedPropertyCard = $('.property-card[data-property-id="' + propertyId + '"]');

                    // Mark the selected tab and property card as active/current
                    $('.tab-link').removeClass('active');
                    $('.property-card').removeClass('current');
                    selectedTab.addClass('active');
                    selectedPropertyCard.addClass('current');

                    // Load the content dynamically
                    loadTabContent(propertyId, tabName);
                }
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
            // if (!hasUrlParams()) {
            //     simulateTabClickAndPropertyCard();
            // }

            // Function to load tab content dynamically via AJAX
            function loadTabContent(propertyId, tabName) {
                // Correctly format the URL with query parameters instead of placeholders
                var url = '{{ route('admin.properties.index') }}' + '?property_id=' + propertyId + '&tabname=' +
                    tabName;

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Update the content of the tab with the response
                        // You might want to populate the content into a specific div
                        // Example: $('.pv_content_detail').html(response.content);
                        $('.pv_content_detail').html(response.content);
                        updateTitle(tabName, propertyId);
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
