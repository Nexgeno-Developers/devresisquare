@extends('backend.layout.app')

@section('content')
<div class="container">
    <h1>Select Repair Category</h1>
    <nav>
        <ol class="breadcrumb" id="breadcrumb">
            <li class="breadcrumb-item active">Repair</li>
        </ol>
    </nav>

    <div id="categories" class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                @include('backend.repair.category', ['category' => $category])
            </div>
        @endforeach
    </div>

    <div id="image-upload" style="display: none;">
        <h3>Select Images</h3>
        <input type="file" multiple id="imageInput" accept="image/*">
    </div>
</div>

<script>
    let breadcrumb = document.getElementById('breadcrumb');
    let imageUpload = document.getElementById('image-upload');

    function updateBreadcrumb(levels) {
        breadcrumb.innerHTML = '<li class="breadcrumb-item active">Home</li>';
        levels.forEach(level => {
            let li = document.createElement('li');
            li.className = 'breadcrumb-item';
            li.textContent = level;
            breadcrumb.appendChild(li);
        });
    }

    function showImageUpload() {
        imageUpload.style.display = 'block';
    }
</script>
@endsection
