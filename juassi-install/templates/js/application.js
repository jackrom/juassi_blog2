jQuery(document).ready(function($)
{
	$('.nav-inventory a, footer > .container > p > a').tooltip();

	setTimeout(function()
	{
		$('#progress-bar div.check').animate(
		{
			backgroundPosition: '-800'
		}, 'slow');

		$('#progress-bar div.license').animate(
		{
			backgroundPosition: '-700'
		}, 'slow');

		$('#progress-bar div.download').animate(
		{
			backgroundPosition: '-600'
		}, 'slow');
		$('#progress-bar div.site-details').animate(
		{
			backgroundPosition: '-500'
		}, 'slow');
		
		$('#progress-bar div.admin-account').animate(
		{
			backgroundPosition: '-350'
		}, 'slow');
		
		$('#progress-bar div.setup-db').animate(
		{
			backgroundPosition: '-250'
		}, 'slow');

		$('#progress-bar div.configuration').animate(
		{
			backgroundPosition: '-150'
		}, 'slow');

		$('#progress-bar div.finish, #progress-bar div.plugins').animate(
		{
			backgroundPosition: '0'
		}, 'slow');
	}, 500);
});