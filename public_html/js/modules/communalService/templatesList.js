/*
*	CityHub - Templates
*/



$(document).ready(function(){
	$('.button-delete-template').click(function(event){
		var companyName = $(this).attr('data-name');
		var fullText = lang_confirm_delete_text.replace('***', companyName);
		var confirmDelete = confirm(fullText);
		if (confirmDelete == false) {
			event.preventDefault();
		}
	});
});