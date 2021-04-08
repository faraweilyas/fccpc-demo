$(document).ready(function (event) {
    $(".approval_body textarea").on("focus keyup", function (event)
    {
        var thisInput     = $(this),
            id            = thisInput.attr('id'),
            content       = thisInput.val(),
            dataClass     = "."+id.toString();
        $(dataClass).addClass("typing");
        console.log(dataClass);
        // Replace newline with  <br />
        if (dataClass == ".approval_content")
            content = content.replace(/(?:\r\n|\r|\n)/g, "<br /><br />")+"<br /><br />";
        $(dataClass).html(content);
    });



    $(".approval_body textarea").on("focusout", function (event)
    {
        var thisInput     = $(this),
            id             = thisInput.attr('id'),
            dataClass     = "."+id.toString();
        $(dataClass).removeClass("typing");
    });
});
