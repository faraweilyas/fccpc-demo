$(document).ready(function($)
{
    $('input[type="file"]').on('change', function(event)
    {
        var fileName = event.target.files[0].name;

        $('.img-info').html(fileName);
    });

    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    };
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
});
