jQuery(document).ready(function($)
{
	$('.nav-inventory a, footer > .container > p > a').tooltip();

	setTimeout(function()
	{
		$('#progress-bar div.check').animate(
		{
			backgroundPosition: '-600'
		}, 'slow');

		$('#progress-bar div.license').animate(
		{
			backgroundPosition: '-400'
		}, 'slow');

		$('#progress-bar div.download').animate(
			{
				backgroundPosition: '-300'
			}, 'slow');

		$('#progress-bar div.configuration').animate(
		{
			backgroundPosition: '-200'
		}, 'slow');

		$('#progress-bar div.finish, #progress-bar div.plugins').animate(
		{
			backgroundPosition: '0'
		}, 'slow');
	}, 500);
});