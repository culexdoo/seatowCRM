/*
*	CityHub - Communal service - delete report subtype
*/



$(document).ready(function() {
	
	// Switcher
	$('#delete').change(function() {
		var thisValue = $(this).val();
		$('#subtype').removeAttr('required');
		switch(thisValue) {
			case '1':
				$('#subtypeGroup').show();
				$('#subtype').attr('required', 'required');
				break;
			case '2':
				$('#subtypeGroup').hide();
				break;
			default:
				$('#subtypeGroup').show();
				$('#subtype').attr('required', 'required');
		}
	});
});
