 var CSRF_TOKEN         = $('meta[name="csrf-token"]').attr('content'),
    counter             = 1,
    arr_length          = $(".checklist_group_count").val(),
    deficient_count     = $(".checklist_deficient_count").html();

$(document).ready(function ()
{
    $('#step-1').show();

    $('#prev').hide();

    $('#prev').click(function()
    {
        if (counter > 1) {
            $('#next').show();
            counter--;
            $('[id^=step]').hide();
            $(`#step-${counter}`).show();
            $(window).scrollTop(0);
        } else {
            $('#next').show();
            counter = 1;
            $('[id^=step]').hide();
            $(`#step-${counter}`).show();
            $(window).scrollTop(0);
            return false;
        }

        $('#approve-checklists').hide();
        $('#deficiency').hide();

        if (counter === 1) $('#prev').hide();
    });

    $('#next').click(function(event)
    {
        event.preventDefault();
        // toastr.success("cool");
        if (counter < arr_length)
        {
            $('#prev').show();
            counter++;
            $('[id^=step]').hide();
            $(`#step-${counter}`).show();
            $(window).scrollTop(0);
        }

        if (parseInt(counter) === parseInt(arr_length))
        {
            $('#next').hide();

            if (parseInt(deficient_count) > 0)
            {
                $('#approve-checklists').hide();
                $('#deficiency').show();
            } else {
                $('#approve-checklists').show();
                $('#deficiency').hide();
            }
        }
    });

    $(".save_approval").on('change', function()
    {
        var formData            = new FormData(),
            case_id             = $(this).attr('data-case-id'),
            doc_id              = $(this).attr('data-document-id'),
            checklist_id        = $(this).attr('data-checklist-id'),
            switch_box          = $(this).attr('data-switch-box'),
            date                = $(this).attr('data-date'),
            reason              = $(this).parent().parent().parent().parent().parent().next().next(),
            remove_checklist    = '',
            status              = '';

        if ($(this).val() == 'deficient')
        {
            $('.toggle-reason-'+checklist_id).removeClass('hide');
        } else {
            $('.toggle-reason-'+checklist_id).addClass('hide');
        }

        if ($(this).is(":checked") && switch_box === "true") {
            remove_checklist = 'no';
            status           = $(this).val();
        } else if(!$(this).is(":checked") && switch_box === "true") {
            remove_checklist = 'yes';
            status           = '';
        } else {
            remove_checklist = 'no';
            status           = $(this).val();
        }

        $.ajax({
            url: '/cases/checklist-approval/'+doc_id,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                checklist: checklist_id,
                status: status,
                remove_checklist: remove_checklist,
                reason: reason.val()
            },
            success: function(response)
            {
                $.ajax({
                    url: '/cases/checklist-status-count/'+case_id+'/'+date,
                    type: 'GET',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {},
                    success: function(response)
                    {
                        var result      = JSON.parse(response);
                        deficient_count = result.response.deficient_cases;
                        deficient_count = (typeof (deficient_count) !== "undefined" || deficient_count != 0) ? deficient_count : 0;

                        if (result.response.deficient_cases === undefined || deficient_count == 0)
                        {
                            $(".checklist-deficient-count").html('0');
                        } else {
                            $(".checklist-deficient-count").html(deficient_count);
                        }

                        if (parseInt(counter) === parseInt(arr_length))
                        {
                            if (parseInt(deficient_count) > 0)
                            {
                                $('#approve-checklists').hide();
                                $('#deficiency').show();
                            } else {
                                $('#approve-checklists').show();
                                $('#deficiency').hide();
                            }
                        }
                    }
                });
            }
        });
    });

    $('.reason').on('keyup', function (event) {
        var formData            = new FormData(),
            doc_id              = $(this).attr('data-document-id'),
            checklist_id        = $(this).attr('data-checklist-id');

        $.ajax({
            url: '/cases/checklist-approval-reason/'+doc_id,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                checklist: checklist_id,
                reason: $(this).val()
            },
            success: function(response)
            { }
        });
    });

    $(".deficient-basket").on('click', function(event)
    {
        var case_id = $(this).attr('data-case-id'),
            date    = $(this).attr('data-date');

        $("#deficient_cases_list div").empty();

        $.ajax({
            url: '/cases/checklist-by-status/'+case_id+'/'+date,
            type: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {},
            success: function(response)
            {
                var result          = JSON.parse(response),
                    deficient_cases = result.response.deficient_cases;

                $.each(deficient_cases, function(index, value)
                {
                    $("#deficient_cases_list").append('<div><p class="alert-custom">'+value.name+'</p></div>');
                });
            }
        });
    });

    $('#viewDeficiencyModal').on('shown.bs.modal', function(event)
    {
        var thisModal               = $(this),
            case_id                 = $('.case_id').html();
            case_doc_date           = $('.case_doc_date').html();
            applicant_firm          = thisModal.find('#applicant_firm'),
            applicant_name          = thisModal.find('#applicant_name'),
            applicant_email         = thisModal.find('#applicant_email'),
            applicant_phone_number  = thisModal.find('#applicant_phone_number'),
            applicant_address       = thisModal.find('#applicant_address');
            issue_deficiency_button = thisModal.find('#issue-deficiency');

        // Get Case Deficiencies Asynchronously
        $.ajax({
            url: '/cases/checklist-by-status/'+case_id+'/'+case_doc_date,
            type: "GET",
            success: function (response) {
                var result = JSON.parse(response);
                $("#deficiency_items").empty();
                $("#deficiency_items").append('<ul>');
                $.each(result.response.deficient_cases, function(index, value)
                {
                    $("#deficiency_items").append('<div class="d-flex align-items-center justify-content-start mb-2">' +
                        '<li class="icon-1x mr-2">'
                        + value.name +
                        '</li>' +
                        '</div>');
                });
                $("#deficiency_items").append('</ul>');
            },
        });

        issue_deficiency_button.attr('data-case-id', case_id);
        issue_deficiency_button.attr('data-date', case_doc_date);
        applicant_firm.html($('.firm').html());
        applicant_name.html($('.name').html());
        applicant_email.html($('.email').html());
        applicant_phone_number.html($('.phone_number').html());
        applicant_address.html($('.address').html());
        return;
    });

    $('#issue-deficiency').on('click', function(event)
    {
        var analyze_case_route = $("#deficiency").attr('data-analyze-case-route');
        $("#saving-deficiency").removeClass('hide');
        $('#issue-deficiency').addClass('hide');
        $.ajax({
            url: '/cases/issue-deficiency/'+$(this).attr('data-case-id')+'/'+$(this).attr('data-date'),
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {additional_info: $("#additional_info").val()},
            success: function(response)
            {
                var result = JSON.parse(response);
                $("#saving-deficiency").addClass('hide');
                $('#issue-deficiency').removeClass('hide');
                swal.fire(
                    "Deficiency Success!",
                    "Applicant has been notified!",
                    "success"
                ).then(function()
                {
                    window.location.href = analyze_case_route;
                });
            },
            error: function (err) {
                $("#saving-deficiency").addClass('hide');
                $('#issue-deficiency').removeClass('hide');
                swal.fire(
                    "Deficiency Not Successful!",
                    "Applicant has not been notified!",
                    "error"
                );
            }
        });
    });

    $('#approve-checklists').on('click', function(event)
    {
        swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, approve it!"
        }).then(function(result)
        {
            if (result.value){
                var case_id            = $("#approve-checklists").attr('data-case-id'),
                    analyze_case_route = $("#approve-checklists").attr('data-analyze-case-route');
                $('#approve-checklists').toggle();
                $("#approving_checklists").removeClass('hide');
                $("#prev").addClass('hide');
                $.ajax({
                    url: '/cases/approve-checklists/'+case_id,
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {additional_info: $("#additional_info").val()},
                    success: function(response)
                    {
                        var result = JSON.parse(response);
                        $("#approving_checklists").addClass('hide');
                        $('#approve-checklists').toggle();
                               swal.fire(
                            "Success!",
                            "Checklists has been approved!",
                            "success"
                        ).then(function()
                        {
                            window.location.href = analyze_case_route;
                        });
                    },
                    error: function (err) {
                        $("#approving_checklists").addClass('hide');
                        $('#approve-checklists').toggle();
                        swal.fire(
                            "Error!",
                            "Checklists has not been approved!",
                            "error"
                        );
                    }
                });
            }
            else
                return false;
        });
    });
});
