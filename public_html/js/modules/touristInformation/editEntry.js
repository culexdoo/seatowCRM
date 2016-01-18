/*
*	CityHub - Tourist information - Edit entry
*/



var map;
var entryMarker;
var entryLatitude;
var entryLongitude;
var cityMarker;
var cityCircle;
var cityLatitude;
var cityLongitude;
var cityRadius;
var cityCenterImage = {
	url: rootPath + '/img/core/ch-city-center.png',
	size: new google.maps.Size(54, 72),
	origin: new google.maps.Point(0, 0),
	anchor: new google.maps.Point(13, 35),
	scaledSize: new google.maps.Size(27, 36),
};
var coordinates;


// Google Maps loading function
function initializeMap(mapLatitude, mapLongitude) {
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(mapLatitude, mapLongitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}



// Set city
function setCity(city_name, city_latitude, city_longitude, city_coordinates, doClick) {

	// Clear if previous value exists
	if (cityMarker !== null && typeof cityMarker === 'object') {
		if (entryMarker !== null && typeof entryMarker === 'object') {
			entryMarker.setMap(null);
			$('#center_latitude, #latitude').val('');
			$('#center_longitude, #longitude').val('');
		}
		cityMarker.setMap(null);
		myPolygon.setMap(null);
	}



	// Create first city marker
	cityMarker = new google.maps.Marker({
		position: new google.maps.LatLng(city_latitude, city_longitude),
		map: map,
		icon: cityCenterImage,
		title: city_name
	});

		coordinates = city_coordinates; 

		var coordinates_array; 	
	    coordinates_array = coordinates.split(";");
	   	coordinates_array.pop();
	    
	    var paths = [];
	    var coordsArr = [];
	    for(i=0; i<coordinates_array.length; i++) {
	    	coordsArr = coordinates_array[i].split(',');
	    	paths.push(new google.maps.LatLng(coordsArr[0], coordsArr[1]));
	    	//console.log(coordinates_array[i]);
	    }

		  // Styling & Controls
		  myPolygon = new google.maps.Polygon({
		    paths: paths,
		    draggable: false, // turn off if it gets annoying
		    editable: false,
		    strokeColor: '#FF0000',
		    strokeOpacity: 0.8,
		    strokeWeight: 2,
		    fillColor: '#FF0000',
		    fillOpacity: 0.35
		  });

		  myPolygon.setMap(map);


	// Reset position
	var newPosition = new google.maps.LatLng(city_latitude, city_longitude);
	map.setCenter(newPosition);



	// Add listener to map to create city center marker
	if (doClick == true) {
		var centerMarkerListener = google.maps.event.addListener(myPolygon, 'click', function(event) {

			// Get click location
			var newLocation = event.latLng;



			// Make the marker and center it
			entryMarker = new google.maps.Marker({
				position: newLocation,
				map: map,
				draggable: true
			});
			map.setCenter(newLocation);



			// Set the values of center marker to fields
			entryLatitude = entryMarker.getPosition().lat();
			entryLongitude = entryMarker.getPosition().lng();
			$('#center_latitude, #latitude').val(entryLatitude);
			$('#center_longitude, #longitude').val(entryLongitude);



			// Redraw circle and get coordinates after dropping city center marker
			google.maps.event.addListener(entryMarker, 'dragend', function() {
				entryLatitude = entryMarker.getPosition().lat();
				entryLongitude = entryMarker.getPosition().lng();
				$('#center_latitude, #latitude').val(entryLatitude);
				$('#center_longitude, #longitude').val(entryLongitude);
			});



			// Remove listener to prevent multiple centers
			google.maps.event.removeListener(centerMarkerListener);
		});
	}
}



$(document).ready(function(){

	// Activate styling on admin note
	adminNote = $('#description').wysihtml5({
		"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": true, //Button to insert a link. Default true
		"image": true, //Button to insert an image. Default true,
		"color": false, //Button to change color of font
		"size": 'sm' //Button size like sm, xs etc.
	});



	// Dynamic categories loading
	$('#city_id').change(function() {
		var newCity = $(this).val();
		var cityValue = $('#city_id').val();
		$('#city_id, #category_id').attr('disabled', 'disabled');
		var loadUsers = $.ajax({
			url: rootPath + '/tourist-information/ajax/city-categories',
			dataType: 'json',
			data: {
				'_token': $('input[name="_token"]').val(),
				'city_id': cityValue,
			},
			type: 'post',
		}).done(function(data) {
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
			$('#city_id, #category_id').removeAttr('disabled');
		}).fail(function(data){
			$('#category_id').empty();
			$('#city_id, #category_id').removeAttr('disabled');
		});
	});



	// Initialize map on first city
	initializeMap(cities[$('#city_id').val()].latitude, cities[$('#city_id').val()].longitude);
	setCity(cities[$('#city_id').val()].name, cities[$('#city_id').val()].latitude, cities[$('#city_id').val()].longitude, cities[$('#city_id').val()].coordinates, false);



	// Change city
	$('#city_id').change(function(){
		var thisID = $(this).val();
		setCity(cities[thisID].name, cities[thisID].latitude, cities[thisID].longitude, cities[thisID].coordinates, true);
	});



	// Get current values
	entryLatitude = $('#center_latitude').val();
	entryLongitude = $('#center_longitude').val();



	// Make the marker and center it
	var newLocation = new google.maps.LatLng(entryLatitude, entryLongitude);
	entryMarker = new google.maps.Marker({
		position: newLocation,
		map: map,
		draggable: true
	});
	map.setCenter(newLocation);



	// Redo the values input after drag
	google.maps.event.addListener(entryMarker, 'dragend', function() {
		entryLatitude = entryMarker.getPosition().lat();
		entryLongitude = entryMarker.getPosition().lng();
		$('#center_latitude, #latitude').val(entryLatitude);
		$('#center_longitude, #longitude').val(entryLongitude);
	});

});