<div class="category text-center">
    <h4>{{ $category->name }}</h4>
    <input type="radio" name="category" value="{{ $category->id }}" onclick="updateBreadcrumb(['{{ $category->name }}'])">

    @if($category->subCategories->isNotEmpty())
        <button class="btn btn-primary mt-2" onclick="showSubCategories({{ $category->id }})">Next</button>

        <div class="sub-categories mt-3 d-none" id="sub-category-{{ $category->id }}">
            @foreach($category->subCategories as $subCategory)
                <div class="col-md-4 mb-4">
                    @include('backend.repair.category', ['category' => $subCategory])
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function showSubCategories(categoryId) {
        // Hide all parent categories
        hideCategories();

        // Show selected category's subcategories
        const subCategoryDiv = document.getElementById(`sub-category-${categoryId}`);

        if (subCategoryDiv) {
            subCategoryDiv.classList.remove('d-none');
            subCategoryDiv.querySelectorAll('input[type=radio]').forEach(input => {
                input.onclick = function() {
                    updateBreadcrumb(['{{ $category->name }}', this.parentNode.querySelector('h4').innerText]);
                    showNextStep();
                };
            });
        }
    }

    function hideCategories() {
        const categoriesDiv = document.getElementById('categories');
        categoriesDiv.style.display = 'none';
    }
</script>
