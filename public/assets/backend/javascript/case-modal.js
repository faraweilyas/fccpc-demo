function setCaseHandlers(caseID)
{
    $.ajax
    ({
        url: "/get/user/casehandlers/"+caseID,
        type: "post",
        data: '',
        success: function(response)
        {
            var result = JSON.parse(response);
            $('#case_handler').html(result.data);
        }
    });
}

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

jQuery(document).ready(function ($)
{
    toastr.options.progressBar = true;

    $('#assignCaseModal').on('shown.bs.modal', function(event)
    {
        console.log(true);
        // var assignButton    = $(event.relatedTarget);
        //     caseID          = assignButton.attr('data-caseID'),
        //     thisModal       = $(this),
        //     caseIDInput     = thisModal.find('#case_id');

        // caseIDInput.val(caseID);
        // setCaseHandlers(caseID);
        // return;
    });

});
