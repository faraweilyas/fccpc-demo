$(document).ready(function () {
    $("#kt_quick_cart_toggle").click(function () {
        $("#show-generate-fee").hide();
        $("#kt_quick_cart").toggleClass("offcanvas-on");
    });

    $("#kt_fee").click(function () {
        $("#show-generate-fee").show();
        $("#kt_quick_cart").toggleClass("offcanvas-on");
    });

    $("#generate-fee").click(function () {
        var application_fee = $(".applicationFee").html().substr(1),
            processing_fee  = $(".processingFee").html().substr(1),
            expedited_fee  = $(".expeditedFee").html().substr(1),
            total_amount   = $(".totalAmount").html().substr(1);

        $(".application_fee").html($(".applicationFee").html());
        $("#application_fee").val(application_fee.slice(0, -3));
        $(".processing_fee").html($(".processingFee").html());
        $("#processing_fee").val(processing_fee.slice(0, -3));
        $(".expedited_fee").html($(".expeditedFee").html());
        $("#expedited_fee").val(expedited_fee.slice(0, -3));
        $(".amount_paid").html($(".totalAmount").html());
        $("#amount_paid").val(total_amount.slice(0, -3));
    });

    $("#kt_quick_cart_close").click(function () {
        $("#show-generate-fee").hide();
        $("#kt_quick_cart").toggleClass("offcanvas-on");
    });
});
