$(document).ready(function() {
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    };

    $('#get_categories').select2();
    $('#get_account_types').select2();

    $('#enquiry_doc').on('change', function(event)
    {
        var fileName = event.target.files[0].name;
        $('.enquiry_doc_name').html(fileName);
    });

    $('#form1A_doc').on('change', function(event)
    {
        var fileName = event.target.files[0].name;
        $('.form1A_doc_name').html(fileName);
    });

    $('.approval-file').on('change', function(event)
    {
        var fileName = event.target.files[0].name;
        $('.doc_name').html(fileName);
    });

    $('#letter_of_appointment_doc').on('change', function(event)
    {
        var fileName = event.target.files[0].name;
        $('.loa_doc_name').html(fileName);
    });

    $(".application_form_doc").on("change", function (event) {
         var fileName  = event.target.files[0].name,
             data_form = $(this).attr('data-form');

        $('.'+data_form).html(fileName);

    });

	$(".start_doc_approval").on('click', function (e) {
		var approval_link  = $(this).attr('data-link');
		var workingon_link = $(this).attr('data-workingon-link');
		 swal.fire({
            title: "Are you sure?",
            text: "You want to start document approval!",
            showCancelButton: true,
            confirmButtonText: "Yes, start process!"
        }).then(function(result)
        {
            if (result.value) {
            	$.ajax({
	                url: workingon_link,
	                type: 'POST',
	                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	                data: {},
	                success: function(response){
	                  window.location.replace(approval_link);
	                }
	            });

            } else {
            	return false;
            }
        });
	});

	$('#kt-search').click(function () {
        $(this).toggleClass('show');
        $('#show_search').toggleClass('show');

    });

    let cases = [];
    let searchInput = document.querySelector('.search-input');
    let suggestionsPanel = document.querySelector('.autoComplete');

    searchInput.addEventListener('keyup', function () {
        let input = searchInput.value;
        if (input !== '') {
            $(".quick-search-close").css("display", "none");
            $(".spin-loader").css("display", "flex");

        	$.ajax({
                url: '/cases/search',
                type: 'GET',
                data: {'search': input},
                success: function(response){
                	$('.dropdown-search').show();
                    $('.dropdown-search').addClass('show');
                    $(".spin-loader").css("display", "none");
                    $(".quick-search-close").css("display", "flex");
                    $('.quick-search-result').empty();
                	$('.quick-search-result').html(response);
            	  }
            });

        } else {
			$('.dropdown-search').hide();
            $(".spin-loader").css("display", "none");
            $(".quick-search-close").css("display", "none");
            $('.quick-search-result').empty();
        }
    });

    $(".quick-search-close").on('click', function (event) {
        $("#search").val('');
       $('.dropdown-search').hide();
        $(this).css("display", "none");
    })

    $(".delete_faq").on('click', function (e) {
        var faq_delete_route  = $(this).attr('data-route');
         swal.fire({
            title: "Are you sure?",
            text: "You want to delete this FAQ!",
            showCancelButton: true,
            confirmButtonText: "Yes, delete FAQ!"
        }).then(function(result)
        {
            if (result.value) {
                $.ajax({
                    url: faq_delete_route,
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {},
                    success: function(response){
                      if(response)
                      {
                        toastr.success("Faq created successfully!");
                        location.reload();
                      } else {
                        toastr.error("Faq not created successfully!");
                      }
                    }
                });

            } else {
                return false;
            }
        });
    });

    $("#mark-notifications").click(function(){
        $.ajax({
            url: '/mark-notifications',
            type: 'GET',
            data: {},
            success: function(response){
                $(".show-marker").removeClass('hide');
            }
        });
    });

    $("#clear-notification").click(function(){
        $.ajax({
            url: '/clear-notification',
            type: 'GET',
            data: {},
            success: function(response){
                $("#read-notifications").empty();
            }
        });
    });
});
