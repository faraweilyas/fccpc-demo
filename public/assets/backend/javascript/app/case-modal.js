var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

function assignCaseHandler(caseID, caseHandlerID) {
    $.ajax({
        url: "/cases/assign/" + caseID + "/" + caseHandlerID,
        type: "post",
        data: {
            _token: CSRF_TOKEN,
        },
        success: function (response) {
            var result = JSON.parse(response);
            $(".assigningCaseButton" + caseID).addClass("hide");
            $(".unassignCaseButton" + caseID).removeClass("hide");
            $(".assignCaseButton" + caseID).addClass("hide");
            $(".unassignCaseButton" + caseID).attr("data-assigned-handler-id", caseHandlerID);
            $(".assigned_handler_id").html(caseHandlerID);
            $('select[name="caseHandler"]').removeAttr("disabled");

            if (result.responseType == "success") {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
        },
        error: function (xhr, desc, err) {
            $(".assignCaseButton" + caseID).removeClass("hide");
            $(".assigningCaseButton" + caseID).addClass("hide");
            $('select[name="caseHandler"]').removeAttr("disabled");
        },
    });
}

function assignAnalyzeCaseHandler(caseID, caseHandlerID) {
    $.ajax({
        url: "/cases/assign/" + caseID + "/" + caseHandlerID,
        type: "post",
        data: {
            _token: CSRF_TOKEN,
        },
        success: function (response) {
            var result = JSON.parse(response);

            if (result.responseType == "success") {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
            location.reload();
        },
        error: function (xhr, desc, err) {
            $("#assignAnalyzeCaseButton").removeClass("hide");
            $("#assigningCaseButton").addClass("hide");
            $('select[name="caseHandler"]').removeAttr("disabled");
        },
    });
}

function unassignCaseHandler(caseID, caseHandlerID) {
    $.ajax({
        url: "/cases/unassign/" + caseID + "/" + caseHandlerID,
        type: "post",
        data: {
            _token: CSRF_TOKEN,
        },
        success: function (response) {
            var result = JSON.parse(response);

            $(".assignCaseButton" + caseID).removeClass("hide");
            $(".unassignCaseButton" + caseID).addClass("hide");
            $(".unassigningCaseButton" + caseID).addClass("hide");
            $('select[name="caseHandler"]').removeAttr("disabled");

            if (result.responseType == "success") {
                toastr.success(result.message);
            } else {
                toastr.error(result.message);
            }
        },
        error: function (xhr, desc, err) {
            $(".assignCaseButton" + caseID).addClass("hide");
            $(".unassigningCaseButton" + caseID).removeClass("hide");
            $(".unassignCaseButton" + caseID).addClass("hide");
        },
    });
}

function reassignCaseHandler(caseID, oldCaseHandlerID, newcaseHandlerID) {
    $.ajax({
        url:
            "/cases/reassign/" +
            caseID +
            "/" +
            oldCaseHandlerID +
            "/" +
            newcaseHandlerID,
        type: "post",
        data: {
            _token: CSRF_TOKEN,
        },
        success: function (response) {
            var result = JSON.parse(response);

            $("#re-unassigning-handler").removeClass("hide");
            $("#re-assigning-handler").addClass("hide");
            $('select[name="newCaseHandler"]').removeAttr("disabled");

            if (result.responseType == "success") {
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
        error: function (xhr, desc, err) {
            $("#re-unassigning-handler").removeClass("hide");
            $("#re-assigning-handler").addClass("hide");
            $('select[name="newCaseHandler"]').removeAttr("disabled");
        },
    });
}

function getIconText(documentID) {
    var icon = "/assets/backend/media/svg/files/pdf.svg";
    $.ajax({
        url: "/cases/document/icon/" + documentID,
        type: "get",
        success: function (response) {
            var result = JSON.parse(response);
            icon = result.response.icon;
        },
    });

    return icon;
}

$(document).ready(function()
{
    $("#unassigned_cases_datatable").DataTable({
        responsive: true,
        paging: true,

        columnDefs: [{ type: "date-dd-mmm-yyyy", targets: 0 }],
    });

    $("#case_handler_dropdown").select2();

    $("#generated_cases_datatable").DataTable({
        responsive: true,
        paging: true,
    });

    $("#assigned_cases_datatable").DataTable({
        responsive: true,
        paging: true,

        columnDefs: [{ type: "date-dd-mmm-yyyy", targets: 0 }],
    });

    $("#case_handlers_datatable").DataTable({
        responsive: true,
        paging: true,
    });

    $("#kt_datatable").DataTable({
        responsive: true,
        paging: true,
    });

    $("#enquiries_log_datatable").DataTable({
        responsive: true,
        paging: true,

        columnDefs: [{ type: "date-dd-mmm-yyyy", targets: 0 }],
    });

    $("#faq_log_datatable").DataTable({
        responsive: true,
        paging: true,

        columnDefs: [{ type: "date-dd-mmm-yyyy", targets: 0 }],
    });

    $("#caseHandler").select2({
        placeholder: "Select a case handler",
        dropdownParent: $("#assignCaseModal"),
        // maximumSelectionLength: 2
        // minimumResultsForSearch: Infinity
        // tags: true
        // allowClear: true
    });

    $("#newCaseHandler").select2({
        placeholder: "Select a case handler",
        dropdownParent: $("#reassignCaseModal"),
    });

    $("#viewCaseModal").on("shown.bs.modal", function (event) {
        var viewButton = $(event.relatedTarget);
        (caseContainer = viewButton.parent().children("div")),
            (thisModal = $(this)),
            (caseID = caseContainer.find(".case_id").html()),
            (analyzeCase = thisModal.find("#analyze-case")),
            (caseHandler = thisModal.find("#case_handler")),
            (refrenceNo = thisModal.find("#refrenceNo")),
            (subject = thisModal.find("#subject")),
            (category = thisModal.find("#category")),
            (category_fee = thisModal.find("#category_fee")),
            (type = thisModal.find("#type")),
            (parties = thisModal.find("#parties")),
            (applicant_firm = thisModal.find("#applicant_firm")),
            (applicant_name = thisModal.find("#applicant_name")),
            (applicant_email = thisModal.find("#applicant_email")),
            (applicant_phone_number = thisModal.find(
                "#applicant_phone_number"
            )),
            (applicant_address = thisModal.find("#applicant_address")),
            (amount_paid = thisModal.find("#amount_paid")),
            (submittedAt = thisModal.find("#submittedAt"));

        // Get Case Checklists Asynchronously
        $.ajax({
            url: "/cases/checklists/" + caseID,
            type: "get",
            success: function (response) {
                var result = JSON.parse(response);
                $("#checklist_items").empty();
                $.each(result.response.checklists, function (index, value) {
                    $("#checklist_items").append(
                        '<div class="d-flex align-items-center justify-content-start mb-2">' +
                            '<span class="icon-1x mr-2"><b>' +
                            (index + 1) +
                            ".</b> " +
                            value +
                            "</span>" +
                            "</div>"
                    );
                });
            },
        });

        analyzeCase.attr("case_id", caseID);
        caseHandler.html(caseContainer.find(".case_handler").html());
        refrenceNo.html(caseContainer.find(".reference_no").html());
        subject.html(caseContainer.find(".subject").html());
        category.html(caseContainer.find(".category").html());
        category_fee.html(caseContainer.find(".category").html());
        type.html(caseContainer.find(".type").html());
        parties.html(caseContainer.find(".parties").html());
        applicant_firm.html(caseContainer.find(".firm").html());
        applicant_name.html(caseContainer.find(".name").html());
        applicant_email.html(caseContainer.find(".email").html());
        applicant_phone_number.html(caseContainer.find(".phone_number").html());
        applicant_address.html(caseContainer.find(".address").html());
        amount_paid.html(caseContainer.find(".amount_paid").html());
        submittedAt.html(caseContainer.find(".submitted_at").html());
        return;
    });

    $("#viewEnqiryModal").on("shown.bs.modal", function (event) {
        var viewButton = $(event.relatedTarget);
        (caseContainer = viewButton.parent().children("div")),
            (thisModal = $(this)),
            (email = thisModal.find("#email")),
            (message = thisModal.find("#message"));
        email.html(caseContainer.find(".email").html());
        message.html(caseContainer.find(".message").html());
        return;
    });

    $("#viewFaqModal").on("shown.bs.modal", function (event) {
        var viewButton = $(event.relatedTarget);
        (caseContainer = viewButton.parent().children("div")),
            (thisModal = $(this)),
            (creator = thisModal.find("#creator"));
        category = thisModal.find("#category");
        question = thisModal.find("#question");
        answer = thisModal.find("#answer");
        created = thisModal.find("#created");

        creator.html(caseContainer.find(".creator").html());
        category.html(caseContainer.find(".category").html());
        question.html(caseContainer.find(".question").html());
        answer.html(caseContainer.find(".answer").html());
        created.html(caseContainer.find(".created").html());
        return;
    });

    $("#assignCaseModal").on("shown.bs.modal", function (event) {
        var assignButton = $(event.relatedTarget);
        (caseContainer = assignButton.parent().children("div")),
            (thisModal = $(this)),
            (caseID = thisModal.find("#caseID")),
            (assignCaseButton = thisModal.find("#assignCaseButton")),
            (unassignCaseButton = thisModal.find("#unassignCaseButton")),
            (assigningCaseButton = thisModal.find("#assigningCaseButton")),
            (unassigningCaseButton = thisModal.find("#unassigningCaseButton")),
            (refrenceNo = thisModal.find("#refrenceNo")),
            (subject = thisModal.find("#subject")),
            (submittedAt = thisModal.find("#submittedAt"));

        caseID.val(caseContainer.find(".case_id").html());
        assignCaseButton.addClass(
            "assignCaseButton" + caseContainer.find(".case_id").html()
        );
        unassignCaseButton.addClass(
            "unassignCaseButton" + caseContainer.find(".case_id").html()
        );
        assigningCaseButton.addClass(
            "assigningCaseButton" + caseContainer.find(".case_id").html()
        );
        unassigningCaseButton.addClass(
            "unassigningCaseButton" + caseContainer.find(".case_id").html()
        );
        unassignCaseButton.attr(
            "data-case-id",
            caseContainer.find(".case_id").html()
        );
        unassignCaseButton.attr(
            "data-assigned-handler-id",
            caseContainer.find(".assigned_handler_id").html()
        );
        refrenceNo.html(caseContainer.find(".reference_no").html());
        subject.html(caseContainer.find(".subject").html());
        submittedAt.html(caseContainer.find(".submitted_at").html());
        return;
    });

    $("#assignEnquiryModal").on("shown.bs.modal", function (event) {
        var assignButton  = $(event.relatedTarget),
            caseContainer = assignButton.parent().children("div"),
            enquiry_id    = caseContainer.find('.enquiry_id').html(),
            thisModal     = $(this);

        thisModal.find('#enquiry_id').val(enquiry_id);

        return;
    });

    $("#viewIDRequestModal").on("shown.bs.modal", function (event) {
        var viewButton    = $(event.relatedTarget),
            viewContainer = viewButton.parent().children("div"),
            email         = viewContainer.find('.email').html(),
            subject       = viewContainer.find('.subject').html(),
            category      = viewContainer.find('.category').html(),
            type          = viewContainer.find('.type').html(),
            parties       = viewContainer.find('.parties').html(),
            thisModal     = $(this);

        thisModal.find('#email').html(email);
        thisModal.find('#subject').html(subject);
        thisModal.find('#category').html(category);
        thisModal.find('#type').html(type);
        thisModal.find('#parties').html(parties);

        return;
    });

    $("#assignCaseModal").on("hidden.bs.modal", function () {
        $("#assignCaseButton").removeClass("hide");
        $("#unassignCaseButton").addClass("hide");
    });

    $("#reassignCaseModal").on("shown.bs.modal", function (event) {
        var reassignButton = $(event.relatedTarget);
        (caseContainer = reassignButton.parent().children("div")),
            (thisModal = $(this)),
            (caseID = thisModal.find("#reassigncaseID")),
            (oldcaseHandlerID = thisModal.find("#oldCaseHandlerID")),
            (caseHandler = thisModal.find("#case_handler")),
            (refrenceNo = thisModal.find("#refrenceNo")),
            (subject = thisModal.find("#subject")),
            (submittedAt = thisModal.find("#submittedAt"));

        caseID.val(caseContainer.find(".case_id").html());
        oldcaseHandlerID.val(caseContainer.find(".case_handler_id").html());
        caseHandler.html(caseContainer.find(".case_handler").html());
        refrenceNo.html(caseContainer.find(".reference_no").html());
        subject.html(caseContainer.find(".subject").html());
        submittedAt.html(caseContainer.find(".submitted_at").html());
        return;
    });

    $("#assignCaseButton").on("click", function (event) {
        event.preventDefault();

        var caseID = $("#caseID").val(),
            caseHandler = $("#caseHandler").val();

        if (isNaN(caseID)) {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0) {
            toastr.error("Please select a case handler!");
            return false;
        }

        $(".assignCaseButton" + caseID).addClass("hide");
        $(".assigningButton" + caseID).removeClass("hide");
        $(".assigningCaseButton" + caseID).removeClass("hide");
        $('select[name="caseHandler"]').attr("disabled", "disabled");
        assignCaseHandler(caseID, caseHandler);
        return;
    });

    $("#assignAnalyzeCaseButton").on("click", function (event) {
        event.preventDefault();
        var caseID = $(this).attr("data-case-id"),
            caseHandler = $("#case_handler_dropdown").val();

        if (isNaN(caseID)) {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0) {
            toastr.error("Please select a case handler!");
            return false;
        }

        $('select[name="caseHandler"]').attr("disabled", "disabled");
        $("#assignAnalyzeCaseButton").addClass("hide");
        $("#assigningCaseButton").removeClass("hide");
        assignAnalyzeCaseHandler(caseID, caseHandler);
        return;
    });

    $(".unassignCaseButton").on("click", function (event) {
        event.preventDefault();

        var caseID = $(this).attr("data-case-id"),
            caseHandler = $(this).attr("data-assigned-handler-id");

        if (isNaN(caseID)) {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0) {
            toastr.error("Please select a case handler!");
            return false;
        }

        $(".assignCaseButton" + caseID).addClass("hide");
        $(".unassignCaseButton" + caseID).addClass("hide");
        $(".unassigningCaseButton" + caseID).removeClass("hide");
        unassignCaseHandler(caseID, caseHandler);
        return;
    });

    $("#unassignCaseButton").on("click", function (event) {
        event.preventDefault();

        var caseID = $(this).attr("data-case-id"),
            caseHandler = $(this).attr("data-assigned-handler-id");

        if (isNaN(caseID)) {
            toastr.error("An error occured!");
            return false;
        }

        if (isNaN(caseHandler) || caseHandler <= 0) {
            toastr.error("Please select a case handler!");
            return false;
        }

        $(".assignCaseButton" + caseID).addClass("hide");
        $(".unassignCaseButton" + caseID).addClass("hide");
        $(".unassigningCaseButton" + caseID).removeClass("hide");
        unassignCaseHandler(caseID, caseHandler);
        return;
    });

    $("#reassignCaseButton").on("click", function (event) {
        event.preventDefault();
        var caseID = $("#reassigncaseID").val(),
            newCaseHandler = $("#newCaseHandler").val();
        oldCaseHandler = $("#oldCaseHandlerID").val();

        if (isNaN(caseID)) {
            toastr.error("An error occured!");
            return false;
        }

        if (
            (isNaN(newCaseHandler) || newCaseHandler <= 0) &&
            (isNaN(oldCaseHandler) || oldCaseHandler <= 0)
        ) {
            toastr.error("Please select a case handler!");
            return false;
        }

        $("#re-unassigning-handler").addClass("hide");
        $("#re-assigning-handler").removeClass("hide");
        $('select[name="newCaseHandler"]').attr("disabled", "disabled");
        reassignCaseHandler(caseID, oldCaseHandler, newCaseHandler);
        return;
    });

    $("#analyze-case").on("click", function (event) {
        window.location.replace("/cases/analyze/" + $(this).attr("case_id"));
    });

    $('#issue-deficiency').on('click', function(event)
    {
        var analyze_case_route = $(this).attr('data-analyze-case-route');

        if ($("#additional_info").val() === ''){
            swal.fire(
                    "Error!",
                    "Additional info text field required!",
                    "error"
                );
                return;
        }

        $("#saving-deficiency").removeClass('hide');
        $('#issue-deficiency').addClass('hide');

        $.ajax({
            url: '/cases/issue-deficiency/'+$(this).attr('data-case-id'),
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
                    location.reload();
                });
            },
            error: function (err) {
                $("#saving-deficiency").addClass('hide');
                $('#issue-deficiency').removeClass('hide');
                swal.fire(
                    "Deficiency Not Successful!",
                    "Applicant has been not notified!",
                    "error"
                );
            }
        });
    });
});
