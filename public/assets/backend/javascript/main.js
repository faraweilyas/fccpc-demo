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
        var total_amount = $(".totalAmount").html().substr(1);
        $(".amount_paid").html($(".totalAmount").html());
        $("#amount_paid").val(total_amount.slice(0, -3));
    });

    $("#kt_quick_cart_close").click(function () {
        $("#show-generate-fee").hide();
        $("#kt_quick_cart").toggleClass("offcanvas-on");
    });
});
