$(document).ready(function () {
    // Function to check if the device is mobile
    function is_mobile() {
        return /Mobi|Android/i.test(navigator.userAgent) || $(window).width() < 768;
    }

    $(".hide-menu").click(function (e) {
        e.preventDefault(),
            $("body").hasClass("hide-sidebar")
                ? $("body").removeClass("hide-sidebar").addClass("show-sidebar")
                : $("body")
                      .removeClass("show-sidebar")
                      .addClass("hide-sidebar");
    }),
        is_mobile() &&
            content_wrapper.on("click", function () {
                $("body").hasClass("show-sidebar") && $(".hide-menu").click();
            });
});

    let selectedFiles = []; // Array to hold selected files

    function previewImage(input) {
        const fileInput = input;
        const imagePreview = fileInput
            .closest(".mb-3")
            .querySelector(".image-preview");
        const uploadedImage = imagePreview.querySelector(".uploaded-image");

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                uploadedImage.src = e.target.result;
                imagePreview.style.display = "block";
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    function removeImage(button) {
        const imagePreview = button.closest(".image-preview");
        const fileInput = imagePreview.previousElementSibling; // Previous sibling is the file input

        // Reset the file input
        fileInput.value = "";
        imagePreview.style.display = "none";
        imagePreview.querySelector(".uploaded-image").src = ""; // Clear the image preview
    }


function previewMultipleImage(input) {
    const fileInput = input;
    const imageWrapper = document.querySelector(".image_wrapper");

    // Clear previously selected files and previews
    selectedFiles = Array.from(fileInput.files);
    // imageWrapper.innerHTML = "";

    selectedFiles.forEach((file) => {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Create the container for each preview
            const mediaImagesDiv = document.createElement("div");
            mediaImagesDiv.className = "media_images mt-2";

            // Create the delete button
            const deleteButtonDiv = document.createElement("div");
            deleteButtonDiv.className = "delete_image";
            deleteButtonDiv.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg>`;
            deleteButtonDiv.onclick = function () {
                removeMultipleImage(mediaImagesDiv, file);
            };

            // Create the image element
            const img = document.createElement("img");
            img.src = e.target.result;
            img.alt = "Uploaded Image";
            // img.style.width = "150px";
            // img.style.height = "auto";

            // Append elements to the preview container
            mediaImagesDiv.appendChild(deleteButtonDiv);
            mediaImagesDiv.appendChild(img);
            imageWrapper.appendChild(mediaImagesDiv);
        };

        reader.readAsDataURL(file);
    });
}

function removeMultipleImage(mediaImagesDiv, file) {
    const imageWrapper = mediaImagesDiv.parentElement;

    // Remove the selected preview element
    imageWrapper.removeChild(mediaImagesDiv);

    // Filter out the removed file
    selectedFiles = selectedFiles.filter((f) => f !== file);

    // Update the file input to reflect the remaining files
    updateFileInput(document.querySelector('#photos'));
}

function updateFileInput(fileInput) {
    const dataTransfer = new DataTransfer();

    // Add remaining files back to DataTransfer
    selectedFiles.forEach((file) => dataTransfer.items.add(file));

    // Set file input's files to the new file list
    fileInput.files = dataTransfer.files;
}
