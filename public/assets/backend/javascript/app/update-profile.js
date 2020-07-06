$(document).ready(function()
{
	$(":input[name=change_pass]").on('change', function(event)
    {
		if (this.value == 'yes') {
			$("#change-password").removeClass('hide');
		}

        if (this.value == 'no') {
			$("#change-password").addClass('hide')
		}
	});
});
