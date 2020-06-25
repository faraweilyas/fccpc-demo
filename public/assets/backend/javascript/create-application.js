jQuery(document).ready(function($)
{
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    };

    $("#save-info").on('click', function(event)
    {
        event.preventDefault();

        var sections    = $('.pb-5'),
            currentForm = sections.filter(function(index, element) {
                            return (typeof ($(element).attr('data-wizard-state')) !== "undefined")
                        }),
            sendForm    = 'save'+currentForm.attr('data-form');

        console.log(sendForm);
        window[sendForm](sendForm);
    });

    $("#upload-info").on('click', function(event)
    {
        event.preventDefault();

        var tracking_id   = $("#tracking_id").val();
        var token         = $("#token").val();
        swal.fire({
                title: "Are you sure?",
                text: "You won\"t be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, submit it!"
            }).then(function(result) {

                if (result.value) {
                    $("#previous-btn").addClass('hide');
                    $("#save-btns").addClass('hide');
                    $("#upload-img").toggle();
                    $.ajax({
                        url: '/api/application/upload/'+tracking_id,
                        data: {
                            '_token': token
                        },
                        type: 'POST',
                        success: function(data) {
                            res = JSON.parse(data);
                            if (res.responseType == "success") {
                                swal.fire(
                                    "Submitted!",
                                    "Your details have been uploaded successfully.",
                                    "success"
                                ).then(function() {
                                    window.location.replace('/application/success/'+tracking_id);
                                });
                            } else {
                                toastr.error("Your details have been not been uploaded successfully.");
                            }
                        },
                        error: function (err) {
                            console.log(err.responseText);
                        }
                    });
                }
            });
    });

    var InputsWrapper   = $(".fields"),
        fieldsCounter   = InputsWrapper.length,
        FieldCount      = 1;

    $('#add-party-fields').on('click', function(event)
    {
        FieldCount++;
        $(InputsWrapper).append('<div class="field-item mt-4" id="field_'+ FieldCount +'">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-5">'+
                                            '<input type="text" class="form-control" placeholder="Enter party name" name="party[]">'+
                                            '<div class="d-md-none mb-2"></div>'+
                                        '</div>'+
                                        '<div class="col-lg-5">'+
                                            '<input type="text" class="form-control" placeholder="Enter party name" name="party[]">'+
                                            '<div class="d-md-none mb-2"></div>'+
                                        '</div>'+
                                        '<div class="col-lg-2">'+
                                            '<a href="#" class="remove">'+
                                                '<span class="svg-icon svg-icon-danger svg-icon-2s">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                                                        '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                                                            '<rect x="0" y="0" width="24" height="24"/>'+
                                                            '<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>'+
                                                            '<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>'+
                                                        '</g>'+
                                                    '</svg>'+
                                                '</span>'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                                );
        fieldsCounter++;
        return false;
    });

    $(document).on("click", ".remove", function(event)
    {
        if (fieldsCounter > 1 ) {
            $(this).closest('.field-item').remove();
            fieldsCounter--;
        }

        return false;
    });
});

function notify(messageType, message)
{
    if (messageType == "success")
        toastr.success(message);

    if (messageType == "error")
        toastr.error(message);

    return;
}

function sendRequest(
    path,
    requestData,
    onSuccess = function(data, status)
    {
        result = JSON.parse(data);
        notify(result.responseType, result.message);
    },
    onError = function(xhr, desc, err)
    {
        notify(desc, err);
    },
    method='POST')
{
    $.ajax({
        url: path,
        data: requestData,
        type: method,
        success: onSuccess,
        error: onError
    });
    return;
}

function saveCaseInfo(action)
{
    var tracking_id = $("#tracking_id").val(),
        case_type   = $("input[name='case_type']:checked").val();

    sendRequest(
        '/application/create/'+tracking_id+'/'+action,
        {
            _token:         $("#token").val(),
            subject:        $("#subject").val(),
            parties:        $("input[name='party[]']").map(function() {
                                return $(this).val();
                            }).get().filter(function(party) {
                                return party != "";
                            }),
            case_type:      (typeof (case_type) === "undefined") ? '' : case_type,
        }
    );
    return;
}

function saveContactInfo(action)
{
    var tracking_id = $("#tracking_id").val();

    sendRequest(
        '/application/create/'+tracking_id+'/'+action,
        {
            _token:                     $("#token").val(),
            applicant_firm:             $("input[name='applicant_firm']").val(),
            applicant_first_name:       $("input[name='applicant_first_name']").val(),
            applicant_last_name:        $("input[name='applicant_last_name']").val(),
            applicant_email:            $("input[name='applicant_email']").val(),
            applicant_phone_number:     $("input[name='applicant_phone_number']").val(),
            applicant_address:          $("input[name='applicant_address']").val(),
        }
    );
    return;
}

function saveCompanyDocuments(action)
{
    //
}

function saveAccountDocuments(action)
{
    //
}

function savePaymentDocuments(action)
{
    //
}
