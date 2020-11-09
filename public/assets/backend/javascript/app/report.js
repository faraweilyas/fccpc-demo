$(document).ready(function () {
    $('#start_date_end_date').flatpickr
    ({
        altInput: true,
        enableTime: false,
        dateFormat: "Y-m-d",
        defaultDate: new Date,
        maxDate: new Date,
        mode: "range"
    });

    $('#get_handler').select2();
    $('#custom-filter-check').on('click', function(){
        if($(this).prop("checked") == true){
            $("#custom-filter").toggle();
        }
        else if($(this).prop("checked") == false){
            $("#custom-filter").toggle();
        }
    });

    $(".toggle-report").on('click', function (event) {
          $("#applications").slideToggle("fast");
    });

    if ($(".check_generator").html() !== '') {
        $("#applications").addClass('hide');
    } else {
        $("#applications").removeClass('hide');
    }
});
