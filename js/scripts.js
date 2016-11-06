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

    $('.cat-select').change(function() {
        var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/')) + "/catalog.php?type=" + $(this).val();

        window.location = dir;
    });

    $('.searchtest').click(function() {
        var dataArray = new Array('sort=' + $('.order-select').val());

        $.ajax({
            url: 'inc/ajaxsearch.php',
            data: dataArray.join('&'),
            success: function(result) {
                console.log(result);
                //console.log($('[name="categories[]"]').val());
                //window.location = result;
            }
        });
        //window.location = window.location.href + "&sort=" + $('.order-select').val();
    });
});
