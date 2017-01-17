;$(function() {
    $(".header-menu-list").on("mouseenter mouseleave", "li", function(e) {
        $(this).children(".sub-menu").toggle();
    })
});