jQuery(document).ready(function($)
{
    $('input[type="file"]').on('change', function(event)
    {
        var fileName = event.target.files[0].name;

        $('.img-info').html(fileName);
    });
});
