;$(function() {
    $(".header-menu-list").on("mouseenter mouseleave", "li", function(e) {
        $(this).children(".sub-menu").toggle();
    })

    $("#J_toggle_sidebox").on("mouseenter", "li", function(e) {
        $(this).removeClass("shrink").siblings("li").addClass("shrink");
    })
});