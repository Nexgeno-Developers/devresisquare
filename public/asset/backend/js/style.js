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
