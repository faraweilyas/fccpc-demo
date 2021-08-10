$(document).ready(function(event)
{
    previewBody($("textarea#approval_content"));
    previewBody($("input#approval_header"));
    previewBody($("textarea#approval_address"));
    $("textarea#approval_content, input#approval_header, textarea#approval_address").on("focus keyup", function(event)
    {
        previewBody($(this));
    });

    $("textarea#approval_content, input#approval_header, textarea#approval_address").on("focusout", function(event)
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
    if (dataClass == ".approval_content" || dataClass == ".approval_address")
    {
        content = content.replace(/(?:\r\n|\r|\n)/g, "<br />");
    }

    $(dataClass).html(content);
}
