var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function assignCaseHandler(caseID, caseHandlerID)
{
    $.ajax
    ({
        url: "/cases/assign/"+caseID+"/"+caseHandlerID,
        type: "post",
        data: {_token: CSRF_TOKEN},
        success: function(response)
        {
            var result  = JSON.parse(response);
            $(".assigningCaseButton"+caseID).addClass('hide');
            $(".unassignCaseButton"+caseID).removeClass('hide');
            $(".assignCaseButton"+caseID).addClass('hide');
            $(".unassignCaseButton"+caseID).attr('data-assigned-handler-id', caseHandlerID);
            $(".assigned_handler_id").html(caseHandlerID);

            if (result.responseType == "success")
            {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
        },
        error: function(xhr, desc, err)
        {
            $(".assignCaseButton"+caseID).removeClass('hide');
            $(".assigningCaseButton"+caseID).addClass('hide');
            $('select[name="caseHandler"]').removeAttr('disabled', 'disabled');
        }
    });
}

function unassignCaseHandler(caseID, caseHandlerID)
{
    $.ajax
    ({
        url: "/cases/unassign/"+caseID+"/"+caseHandlerID,
        type: "post",
        data: {_token: CSRF_TOKEN},
        success: function(response)
        {
            var result = JSON.parse(response);
            
            $(".assignCaseButton"+caseID).removeClass('hide');
            $(".unassignCaseButton"+caseID).addClass('hide');
            $(".unassigningCaseButton"+caseID).addClass('hide');
            $('select[name="caseHandler"]').removeAttr('disabled', 'disabled');

            if (result.responseType == "success")
            {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
        },
        error: function(xhr, desc, err)
        {
            $(".assignCaseButton"+caseID).addClass('hide');
            $(".unassigningCaseButton"+caseID).removeClass('hide');
            $(".unassignCaseButton"+caseID).addClass('hide');
        }
    });
}

function reassignCaseHandler(caseID, oldCaseHandlerID, newcaseHandlerID)
{
    $.ajax
    ({
        url: "/cases/reassign/"+caseID+"/"+oldCaseHandlerID+"/"+newcaseHandlerID,
        type: "post",
        data: {_token: CSRF_TOKEN},
        success: function(response)
        {
            var result = JSON.parse(response);

            $("#re-unassigning-handler").removeClass('hide');
            $("#re-assigning-handler").addClass('hide');
            $('select[name="newCaseHandler"]').removeAttr('disabled', 'disabled');

            if (result.responseType == "success")
            {
                toastr.success(result.message);
                // setTimeout(
                //   function()
                //   {
                //     location.reload();
                //   }, 3500);
            } else {
                toastr.error(result.message);
            }
        },
        error: function(xhr, desc, err)
        {
            $("#re-unassigning-handler").removeClass('hide');
            $("#re-assigning-handler").addClass('hide');
            $('select[name="newCaseHandler"]').removeAttr('disabled', 'disabled');
        }
    });
}

function getIconText(documentID) 
{
    var icon = '/assets/backend/media/svg/files/pdf.svg';
    $.ajax
        ({
            url: "/cases/document/icon/"+documentID,
            type: "get",
            success: function(response)
            {
                var result = JSON.parse(response);
                icon = result.response.icon;
            }
        });

    return icon;
}

$(document).ready(function()
{
    $('#unassigned_cases_datatable').DataTable
    ({
        responsive: true,
        paging: true,
    });

    $('#caseHandler').select2
    ({
        placeholder: "Select a case handler",
        dropdownParent: $("#assignCaseModal"),
        // maximumSelectionLength: 2
        // minimumResultsForSearch: Infinity
        // tags: true
        // allowClear: true
    });

    $('#newCaseHandler').select2
    ({
        placeholder: "Select a case handler",
        dropdownParent: $("#reassignCaseModal"),
    });

    $('#viewCaseModal').on('shown.bs.modal', function(event)
    {
        var viewButton              = $(event.relatedTarget);
            caseContainer           = viewButton.parent('td').parent('tr'),
            thisModal               = $(this),
            caseID                  = caseContainer.find('.case_id').html(),
            caseHandler             = thisModal.find('#case_handler'),
            refrenceNo              = thisModal.find('#refrenceNo'),
            subject                 = thisModal.find('#subject'),
            category                = thisModal.find('#category'),
            type                    = thisModal.find('#type'),
            parties                 = thisModal.find('#parties'),
            applicant_firm          = thisModal.find('#applicant_firm'),
            applicant_name          = thisModal.find('#applicant_name'),
            applicant_email         = thisModal.find('#applicant_email'),
            applicant_phone_number  = thisModal.find('#applicant_phone_number'),
            applicant_address       = thisModal.find('#applicant_address'),
            submittedAt             = thisModal.find('#submittedAt');

        // Get Case Checklists Asynchronously
        $.ajax
        ({
            url: "/cases/checklists/"+caseID,
            type: "get",
            success: function(response)
            {
                var result = JSON.parse(response);
                $("#checklist_items").empty();
                $.each(result.response.checklists, function(index, value){
                    $("#checklist_items").append('<div class="d-flex align-items-center justify-content-start mb-2">'+
                                                    '<span class="icon-1x mr-2"><b>'+
                                                        (index+1)+'.</b> '+value
                                                    +'</span>'+
                                                 '</div>');
                });
            },
        });

         // Get Case Documents Asynchronously
        $.ajax
        ({
            url: "/cases/documents/"+caseID,
            type: "get",
            success: function(response)
            {
                var result = JSON.parse(response);
                $("#document_items").empty();
                $.each(result.response.documents, function(index, value){
                    $("#document_items").append('<div class="d-flex align-items-center justify-content-between mb-2">'+
                                                    '<span class="font-weight-bold mr-2">'+
                                                        '<a href="#" class="d-flex align-items-center text-muted text-hover-success py-1">'+
                                                            '<img class="max-h-30px mr-3" src="'+getIconText(value.id)+'" />'+
                                                            '<span class="icon-1x mr-2">'+result.response.group[index]+'</span>'+
                                                        '</a>'+
                                                    '</span>'+
                                                    '<span class="text-body text-hover-info" id="applicant_phone_number">'+
                                                        '<a href="/applicant/document/download/'+value.id+'" class="text-muted text-hover-success mr-2">'+
                                                            '<span class="flaticon2-download icon-1x"></span> Download'+
                                                        '</a>'+
                                                    '</span>'+
                                                '</div>'
                                                );
                });
            }
        });

        caseHandler.html(caseContainer.find('.case_handler').html());
        refrenceNo.html(caseContainer.find('.reference_no').html());
        subject.html(caseContainer.find('.subject').html());
        category.html(caseContainer.find('.category').html());
        type.html(caseContainer.find('.type').html());
        parties.html(caseContainer.find('.parties').html());
        applicant_firm.html(caseContainer.find('.firm').html());
        applicant_name.html(caseContainer.find('.name').html());
        applicant_email.html(caseContainer.find('.email').html());
        applicant_phone_number.html(caseContainer.find('.phone_number').html());
        applicant_address.html(caseContainer.find('.address').html());
        submittedAt.html(caseContainer.find('.submitted_at').html());
        return;
    });

    $('#assignCaseModal').on('shown.bs.modal', function(event)
    {
        var assignButton          = $(event.relatedTarget);
            caseContainer         = assignButton.parent('td').parent('tr'),
            thisModal             = $(this),
            caseID                = thisModal.find('#caseID'),
            assignCaseButton      = thisModal.find('#assignCaseButton'),
            unassignCaseButton    = thisModal.find('#unassignCaseButton'),
            assigningCaseButton   = thisModal.find('#assigningCaseButton'),
            unassigningCaseButton = thisModal.find('#unassigningCaseButton'),
            refrenceNo            = thisModal.find('#refrenceNo'),
            subject               = thisModal.find('#subject'),
            submittedAt           = thisModal.find('#submittedAt');

        caseID.val(caseContainer.find('.case_id').html());
        assignCaseButton.addClass("assignCaseButton"+caseContainer.find('.case_id').html());
        unassignCaseButton.addClass("unassignCaseButton"+caseContainer.find('.case_id').html());
        assigningCaseButton.addClass("assigningCaseButton"+caseContainer.find('.case_id').html());
        unassigningCaseButton.addClass("unassigningCaseButton"+caseContainer.find('.case_id').html());
        unassignCaseButton.attr("data-case-id", caseContainer.find('.case_id').html());
        unassignCaseButton.attr("data-assigned-handler-id", caseContainer.find('.assigned_handler_id').html());
        refrenceNo.html(caseContainer.find('.reference_no').html());
        subject.html(caseContainer.find('.subject').html());
        submittedAt.html(caseContainer.find('.submitted_at').html());
        return;
    });

    $('#assignCaseModal').on('hidden.bs.modal', function () {
      $("#assignCaseButton").removeClass('hide');
      $("#unassignCaseButton").addClass('hide');
    });

    $('#reassignCaseModal').on('shown.bs.modal', function(event)
    {
        var reassignButton      = $(event.relatedTarget);
            caseContainer       = reassignButton.parent('td').parent('tr'),
            thisModal           = $(this),
            caseID              = thisModal.find('#reassigncaseID'),
            oldcaseHandlerID    = thisModal.find('#oldCaseHandlerID'),
            caseHandler         = thisModal.find('#case_handler'),
            refrenceNo          = thisModal.find('#refrenceNo'),
            subject             = thisModal.find('#subject'),
            submittedAt         = thisModal.find('#submittedAt');

        caseID.val(caseContainer.find('.case_id').html());
        oldcaseHandlerID.val(caseContainer.find('.case_handler_id').html());
        caseHandler.html(caseContainer.find('.case_handler').html());
        refrenceNo.html(caseContainer.find('.reference_no').html());
        subject.html(caseContainer.find('.subject').html());
        submittedAt.html(caseContainer.find('.submitted_at').html());
        return;
    });

    $("#assignCaseButton").on("click", function(event)
    {
        event.preventDefault();

        var caseID      = $("#caseID").val(),
            caseHandler = $("#caseHandler").val();

        if (isNaN(caseID))
        {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0)
        {
            toastr.error("Please select a case handler!");
            return false;
        }

        $(".assignCaseButton"+caseID).addClass('hide');
        $(".assigningButton"+caseID).removeClass('hide');
        $('select[name="caseHandler"]').attr('disabled', 'disabled');
        assignCaseHandler(caseID, caseHandler);
        return;
    });

    $(".unassignCaseButton").on("click", function(event)
    {
        event.preventDefault();

        var caseID      = $(this).attr('data-case-id'),
            caseHandler = $(this).attr('data-assigned-handler-id');

        if (isNaN(caseID))
        {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0)
        {
            toastr.error("Please select a case handler!");
            return false;
        }

        $(".assignCaseButton"+caseID).addClass('hide');
        $(".unassignCaseButton"+caseID).addClass('hide');
        $(".unassigningCaseButton"+caseID).removeClass('hide');
        unassignCaseHandler(caseID, caseHandler);
        return;
    });

    $("#unassignCaseButton").on("click", function(event)
    {   
        event.preventDefault();

        var caseID      = $(this).attr('data-case-id'),
            caseHandler = $(this).attr('data-assigned-handler-id');

        if (isNaN(caseID))
        {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0)
        {
            toastr.error("Please select a case handler!");
            return false;
        }

        $(".assignCaseButton"+caseID).addClass('hide');
        $(".unassignCaseButton"+caseID).addClass('hide');
        $(".unassigningCaseButton"+caseID).removeClass('hide');
        unassignCaseHandler(caseID, caseHandler);
        return;
    });

    $("#reassignCaseButton").on("click", function(event)
    {
        event.preventDefault();
        var caseID         = $("#reassigncaseID").val(),
            newCaseHandler = $("#newCaseHandler").val();
            oldCaseHandler = $("#oldCaseHandlerID").val();

        if (isNaN(caseID))
        {
            toastr.error("An error occured!");
            return false;
        }

        if ((isNaN(newCaseHandler) || newCaseHandler <= 0) && (isNaN(oldCaseHandler) || oldCaseHandler <= 0))
        {
            toastr.error("Please select a case handler!");
            return false;
        }

        $("#re-unassigning-handler").addClass('hide');
        $("#re-assigning-handler").removeClass('hide');
        $('select[name="newCaseHandler"]').attr('disabled', 'disabled');
        reassignCaseHandler(caseID, oldCaseHandler, newCaseHandler);
        return;
    });
});
