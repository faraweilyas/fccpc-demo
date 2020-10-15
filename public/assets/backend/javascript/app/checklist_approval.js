 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var counter    = 1;
    var arr_lenght = $(".checklist_group_count").val();

    $(document).ready(function () {
        $('#step-1').show();
        $('#prev').hide();
        $('#prev').click(function () {
            if (counter > 1) {
                $('#next').show();
                $('#approve').hide();
                counter--;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                $(window).scrollTop(0);
            } else {
                $('#next').show();
                $('#approve').hide();
                counter = 1;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                $(window).scrollTop(0);
                return false;
            }


            if (counter === 1) {
                $('#prev').hide();

            }

        })
        $('#next').click(function (event) {
            event.preventDefault();
            // toastr.success("cool");
            if (counter < arr_lenght) {
                $('#prev').show();

                counter++;
                $('[id^=step]').hide();
                $(`#step-${counter}`).show();
                $(window).scrollTop(0);

            }

            if (parseInt(counter) === parseInt(arr_lenght)) {
                $('#next').hide();
                $('#approve').show();
            }


        });

        $(".save_approval").on('change', function(){
            var formData      = new FormData(),
                case_id       = $(this).attr('data-case-id'),
                doc_id        = $(this).attr('data-document-id'),
                checklist_id  = $(this).attr('data-checklist-id'),
                status        = $(this).val();
            $.ajax({
                url: '/cases/checklist-approval/'+doc_id,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {checklist: checklist_id, status: status}, 
                success: function(response){
                  // console.log(response);
                }
            });

            $.ajax({
                url: '/cases/checklist-status-count/'+case_id,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {}, 
                success: function(response){
                    var result = JSON.parse(response);
                    $("#checklist-deficient-count").html(result.response.deficient)
                }
            });
        });

        $("#deficient-basket").on('click', function (event) {
            var case_id = $(this).attr('data-case-id');
            $("#deficient_cases_list div").empty();
            $.ajax({
                url: '/cases/checklist-by-status/'+case_id,
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {}, 
                success: function(response){
                    var result          = JSON.parse(response);
                    var deficient_cases = result.response.deficent_cases;
                    $.each(deficient_cases, function(index, value){
                        $("#deficient_cases_list").append('<div>'
                                                            +'<p class="alert-custom ">'
                                                            +value.name
                                                            +'</p>'
                                                            +'</div>'
                                                        );
                    });
                }
            });
        });
    });
