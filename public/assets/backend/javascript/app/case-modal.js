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
            var caseId  = result.response.case.id;
            var handler = result.response.handler.id;

            $("#assigning-handler").addClass('hide');
            $("#unassign-handler-btn").removeClass('hide');
            $('select[name="caseHandler"]').removeAttr('disabled', 'disabled');
            $("#assign"+caseId).addClass('hide');
            $("#unassign"+caseId).removeClass('hide');
            $("#unassign"+caseId).attr('data-assigned-handler-id', handler);

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
            $("#unassigning-handler").removeClass('hide');
            $("#assigning-handler").addClass('hide');
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
            console.log(result);
            if (result.responseType == "success")
            {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
        },
        error: function(xhr, desc, err)
        {
            
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
        var assignButton        = $(event.relatedTarget);
            caseContainer       = assignButton.parent('td').parent('tr'),
            thisModal           = $(this),
            caseID              = thisModal.find('#caseID'),
            refrenceNo          = thisModal.find('#refrenceNo'),
            subject             = thisModal.find('#subject'),
            submittedAt         = thisModal.find('#submittedAt');

        caseID.val(caseContainer.find('.case_id').html());
        refrenceNo.html(caseContainer.find('.reference_no').html());
        subject.html(caseContainer.find('.subject').html());
        submittedAt.html(caseContainer.find('.submitted_at').html());
        return;
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

        $("#unassigning-handler").addClass('hide');
        $("#assigning-handler").removeClass('hide');
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
