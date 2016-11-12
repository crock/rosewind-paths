$(document).ready(function() {
    $('.carousel-inner > .item:first-of-type').addClass('active');
    $('.carousel').carousel({
      interval: 3000
    });

    $('.cat-select').change(function() {
        var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/')) + "/catalog.php?type=" + $(this).val();

        window.location = dir;
    });
});
