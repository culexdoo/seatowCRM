/*
*	CityHub - Landing (superadmin)
*/



$(document).ready(function() {
	$('#cityJumper').click(function() {
		var cityID = $('#citySelector').val();
		var fullLink = routeLink.replace('tempIDplaceholder', cityID);
		window.location.assign(fullLink);
	});
});
