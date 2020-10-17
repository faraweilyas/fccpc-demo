$(document).ready(function() {
	$("#start_doc_approval").on('click', function (e) {
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
        	 $.ajax({
            url: '/cases/search',
            type: 'GET',
            data: {'search': input}, 
            success: function(response){
            	$(".autoComplete").css("display", "block");
            	$('.autoComplete').html(response);
        	  }
            });

        } else {
			$('.autoComplete').hide();
        }
    });
});
