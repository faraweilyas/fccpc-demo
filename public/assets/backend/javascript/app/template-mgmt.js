$(document).ready(function(event)
{
    previewBody($(".approval_body textarea"));
    $(".approval_body textarea").on("focus keyup", function(event)
    {
        previewBody($(this));
    });

    $(".approval_body textarea").on("focusout", function(event)
    {
        var thisInput   = $(this),
            id          = thisInput.attr('id'),
            dataClass   = "."+id.toString();
        $(dataClass).removeClass("typing");
    });
});

function previewBody(thisInput)
{
    var id            = thisInput.attr('id'),
        content       = thisInput.val(),
        dataClass     = "."+id.toString();

    $(dataClass).addClass("typing");
    // Replace newline with  <br />
    if (dataClass == ".approval_content")
    {
        content = content.replace(/(?:\r\n|\r|\n)/g, "<br />");
    }

    $(dataClass).html(content);
}
