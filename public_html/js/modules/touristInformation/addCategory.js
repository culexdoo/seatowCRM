/*
*	CityHub - Add category
*/

$(document).ready(function(){
	$('#city_id').change(function(){
		var newCity = $(this).val();
		var cityValue = $('#city_id').val();
		$('#city_id').attr('disabled', 'disabled');
		var loadUsers = $.ajax({
			url: rootPath + '/tourist-information/ajax/city-categories',
			dataType: 'json',
			data: {
				'_token': $('input[name="_token"]').val(),
				'city_id': cityValue,
			},
			type: 'post',
		}).done(function(data){
			$('#category_id').empty();
			if (data.status == 1) {
				if (typeof data.categories != 'undefined') {
					var userOptions = '';
					$.each(data.categories, function(index, value){
						userOptions += ' <option value="'+ index +'">'+ value +'</option>';
					});
					$('#category_id').append(userOptions);
				} else {
					$('#category_id').empty();
 				}
			} else {
				$('#category_id').empty();
 			}
			$('#city_id').removeAttr('disabled');
		}).fail(function(data){
			$('#category_id').empty();
 			$('#city_id').removeAttr('disabled');
		});
	});
});