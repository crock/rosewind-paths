$(document).ready(function() {
    $('.carousel-inner > .item:first-of-type').addClass('active');
    $('.carousel').carousel({
      interval: 3000
    });
});
