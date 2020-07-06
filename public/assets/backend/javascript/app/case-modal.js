function assignCaseHandler(caseID, caseHandlerID)
{
    $.ajax
    ({
        url: "/reported-case/assign/"+caseID+"/"+caseHandlerID,
        type: "post",
        data: '',
        success: function(response)
        {
            var result = JSON.parse(response);
            if (result.status == "success")
            {
                var caseStatus  = $(".case_row_"+caseID).children('.case-status'),
                    caseHandler = $(".case_row_"+caseID).children('.case__data').children('.case-handler');
                caseStatus.html(result.data.htmlStatus);
                caseHandler.html(result.data.caseHandler);
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
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

    $('#case_handler').select2
    ({
        placeholder: "Select a case handler",
        dropdownParent: $("#assignCaseModal"),
        // maximumSelectionLength: 2
        // minimumResultsForSearch: Infinity
        // tags: true
        // allowClear: true
    });

    $('#viewCaseModal').on('shown.bs.modal', function(event)
    {
        var viewButton              = $(event.relatedTarget);
            caseContainer           = viewButton.parent('td').parent('tr'),
            thisModal               = $(this),
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
            refrenceNo          = thisModal.find('#refrenceNo'),
            subject             = thisModal.find('#subject'),
            submittedAt         = thisModal.find('#submittedAt');

        refrenceNo.html(caseContainer.find('.reference_no').html());
        subject.html(caseContainer.find('.subject').html());
        submittedAt.html(caseContainer.find('.submitted_at').html());
        return;
    });

    $("#assignSubmitBtn").on("click", function(event)
    {
        event.preventDefault();

        var thisModal   = $("#modalAssignCase"),
            caseID      = $("#case_id").val(),
            caseHandler = $("#case_handler").val();

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
        assignCaseHandler(caseID, caseHandler);
        return;
    });
});
