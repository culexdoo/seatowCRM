/*
*	CityHub - Tourist information - Categories
*/



$(document).ready(function(){
	$('.button-delete-category').click(function(event){
		var reportID = $(this).attr('data-name');
		var fullText = lang_category_delete.replace('***', reportID);
		var confirmDelete = confirm(fullText);
		if (confirmDelete == false) {
			event.preventDefault();
		}
	});
});
