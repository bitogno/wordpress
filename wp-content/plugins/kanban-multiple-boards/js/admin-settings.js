jQuery(function($)
{
	$('#select-multiple-boards').on(
		'change',
		function ()
		{
			window.location = $(this).val();
		}
	);
});