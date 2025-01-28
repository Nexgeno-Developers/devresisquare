@extends('backend.layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Raise Repair Issue</li>
                <!-- Breadcrumb items will be added dynamically -->
            </ol>
        </nav>

        <!-- Navigation Buttons -->
        <div class="d-flex">
            <button id="prev-btn" class="btn btn-secondary d-none">Previous</button>
            <button id="next-btn" class="btn btn-primary" disabled>Next</button>
        </div>
    </div>

    <h3>Select a Category</h3>

    <div class="main-view">
        <!-- Default Level 1 (Parent Categories) -->
        <div class="category-level" data-level="1">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-4">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="parent_category" id="parent-{{ $category->id }}" value="{{ $category->id }}">
                        <label class="form-check-label d-flex align-items-center" for="parent-{{ $category->id }}">
                            <i class="fas fa-cogs me-2"></i> <!-- Font Awesome icon -->
                            {{ $category->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Dynamically Generated Levels -->
        @for ($level = 2; $level <= $maxLevel; $level++)
            <div class="category-level" data-level="{{ $level }}" style="display: none;">
                <!-- Placeholder for level {{ $level }} -->
                <div class="row"></div>
            </div>
        @endfor
    </div>
</div>

    <!-- Include Common Form on the Last Step -->
    <div id="repair-form" class="d-none">
        @include('backend.repair.common_form')
    </div>



@endsection

@section('page.scripts')
<script>
    $(document).ready(function () {
    let currentLevel = 1;
    let selectedCategories = {}; // Store selected category IDs by level

    // Update Breadcrumb
    function updateBreadcrumb(name) {
        const breadcrumb = $('ol.breadcrumb');
        breadcrumb.find('li').removeClass('active').last().addClass('active');
        breadcrumb.append(
            `<li class="breadcrumb-item active" aria-current="page">${name}</li>`
        );
    }

    function checkLastStep(selectedCategories) {
        $.ajax({
            url: "{{ route('admin.repair.checkLastStep') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                selectedCategories: selectedCategories
            },
            success: function(response) {
                if (response.isLastStep) {
                    // Hide the next button and show the form if it's the last step
                    $('#next-btn').prop('disabled', true);
                    $('#prev-btn').addClass('d-none');
                    $('#next-btn').addClass('d-none');
                    $('#repair-form').removeClass('d-none'); // Show the form
                }
            },
            error: function(error) {
                AIZ.plugins.notify('error', 'An error occurred while checking the last step.');
            }
        });
    }

    // Handle Next Button Click
    $('#next-btn').on('click', function () {
        const visibleLevel = $(`.category-level[data-level="${currentLevel}"]`);
        const selectedRadio = visibleLevel.find('input[type="radio"]:checked');

        if (!selectedRadio.length) return; // No category selected

        const selectedValue = selectedRadio.val();
        const selectedName = selectedRadio.siblings('label').text().trim();

        // Store the selected category for the current level
        selectedCategories[currentLevel] = selectedValue;
        console.log('Selected Categories:', selectedCategories);

        // Fetch Subcategories for the Next Level
        $.ajax({
            url: "{{ route('admin.property_repairs.getSubCategories', ['categoryId' => '__categoryId__']) }}".replace('__categoryId__', selectedValue),
            method: 'GET',
            success: function (data) {
                if (data.length) {
                    const nextLevelContainer = $(`[data-level="${currentLevel + 1}"]`);
                    let html = '';
                    data.forEach((category) => {
                        html += `
                            <div class="col-md-4">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="category_${currentLevel + 1}" id="category-${category.id}" value="${category.id}">
                                    <label class="form-check-label d-flex align-items-center" for="category-${category.id}">
                                        <i class="fas fa-cogs me-2"></i> ${category.name}
                                    </label>
                                </div>
                            </div>
                        `;
                    });

                    nextLevelContainer.find('.row').html(html);
                    $('.category-level').hide(); // Hide all levels
                    nextLevelContainer.show(); // Show next level
                    currentLevel++;
                    $('#prev-btn').removeClass('d-none'); // Show Previous button
                    $('#next-btn').prop('disabled', true); // Disable Next button

                } else {
                    // Call checkLastStep to determine if it's the last step
                    // checkLastStep(selectedCategories);  // Call the function here
                }

                // Add to breadcrumb
                updateBreadcrumb(selectedName);
            },
            error: function (error) {
                // Call checkLastStep to determine if it's the last step
                checkLastStep(selectedCategories);  // Call the function here
                if (error.responseJSON && error.responseJSON.message) {
                    AIZ.plugins.notify('error', error.responseJSON.message); // Show error message using AIZ notification
                } else {
                    AIZ.plugins.notify('error', 'An unknown error occurred while fetching subcategories.'); // Default error message
                }
            }
        });
    });

    // Handle Previous Button Click
    $('#prev-btn').on('click', function () {
        if (currentLevel > 1) {
            $(`[data-level="${currentLevel}"]`).hide().find('.row').empty(); // Hide and clear current level
            currentLevel--;
            $(`[data-level="${currentLevel}"]`).show(); // Show previous level
            $('ol.breadcrumb li').last().remove(); // Remove last breadcrumb
            if (currentLevel === 1) {
                $('#prev-btn').addClass('d-none'); // Hide Previous button if on first level
            }
            $('#next-btn').prop('disabled', false); // Enable Next button
        }
    });

    // Enable Next Button on Radio Selection
    $(document).on('change', 'input[type="radio"]', function () {
        $('#next-btn').prop('disabled', false);
    });

});


    </script>
@endsection
