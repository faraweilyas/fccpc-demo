$(document).ready(function () {
    $(":input[name=change_pass]").on("change", function (event) {
        if (this.value == "yes") {
            $("#change-password").removeClass("hide");
        }

        if (this.value == "no") {
            $("#change-password").addClass("hide");
        }
    });

    $("#edit-profile-control").click(function () {
        $(this).toggleClass("card__box-stack-active");
        $("#change-password-control").removeClass("card__box-stack-active");
        $("#edit-profile-card").toggleClass("hide");
        $("#change-password-card").addClass("hide");
    });
    $("#change-password-control").click(function () {
        $(this).toggleClass("card__box-stack-active");
        $("#edit-profile-control").removeClass("card__box-stack-active");
        $("#edit-profile-card").addClass("hide");
        $("#change-password-card").toggleClass("hide");
    });
});
