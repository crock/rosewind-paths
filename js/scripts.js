$(document).ready(function() {
    $('.carousel-inner > .item:first-of-type').addClass('active');
    $('.carousel').carousel({
      interval: 3000
    });

    $('.form-search').submit(function(submit) {
        submit.preventDefault();
        var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/')) + "/catalog.php?search=" + $(this).find('[type=text]').val();

        window.location = dir;
    });
});
