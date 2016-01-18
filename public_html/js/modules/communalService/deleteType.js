/*
*	CityHub - Communal service - delete report type
*/



$(document).ready(function() {
	
	// Switcher
	$('#delete').change(function() {
		var thisValue = $(this).val();
		$('#type, #subtype').removeAttr('required');
		switch(thisValue) {
			case '1':
				$('#typeGroup').show();
				$('#type').attr('required', 'required');
				$('#subtypeGroup').hide();
				break;
			case '2':
				$('#typeGroup').hide();
				$('#subtypeGroup').show();
				$('#subtype').attr('required', 'required');
				break;
			case '3':
				$('#typeGroup, #subtypeGroup').hide();
				break;
			default:
				$('#typeGroup, #subtypeGroup').show();
		}
	});
});
