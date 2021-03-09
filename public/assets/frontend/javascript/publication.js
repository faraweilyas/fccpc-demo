$(document).ready(function(){
    $("#publication_search").on("change", "input:checkbox", function(){
        $("#publication_search").submit();
    });

    $('.publication-search-input').keypress(function (e) {
        if (e.which == 13) {
          $('#publication_search').submit();
          return false;
        }
    });

    $(".publication__btn").on('click', function (e) {
        if ($(this).children('i').hasClass('fa-arrow-down')){
            $(this).children('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
        } else {
            $(this).children('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
        }
    });
});
