/*
*	CityHub - Communal Service - Edit report
*/



var map;
var citySelectedID;
var cityMarker;
var cityCircle;
var	cityCenterImage = {
	url: rootPath + '/img/core/ch-city-center.png',
	size: new google.maps.Size(54, 72),
	origin: new google.maps.Point(0, 0),
	anchor: new google.maps.Point(13, 35),
	scaledSize: new google.maps.Size(27, 36),
};
var reportMarker;
var reportLatitude;
var reportLongitude;
var reportStatus;
var reportMarkerImage;

// Google Maps loading function
function initializeMap(reportLatitude, reportLongitude) {
	var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(reportLatitude, reportLongitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


 

// Function that removes previous city and renders a new one
function renderOtherCity(selectedCityID) {

	// Kill previous elements
	cityMarker.setMap(null);
	cityCircle.setMap(null);



	// If city is selected, render it
	if (selectedCityID != 0) {
		
		// Render city center
		cityMarker = new google.maps.Marker({
			position: new google.maps.LatLng(citiesData[selectedCityID].latitude, citiesData[selectedCityID].longitude),
			map: map,
			title: citiesData[selectedCityID].name,
			icon: cityCenterImage,
			zIndex: 5
		}); 
	}
}



$(document).ready(function() {


	// Load current report values
	reportLatitude = $('#reportLatitude').val();
	reportLongitude = $('#reportLongitude').val();
	reportStatus = parseInt($('#status').val());
	citySelectedID = parseInt($('#city').val());
 	coordinates = $('#coordinates').val();
   
  	var myLatlng = new google.maps.LatLng(reportLatitude,reportLongitude);
  
	$("#triggermap").on('click', function() {
		setTimeout(function(){
			google.maps.event.trigger(map, 'resize');
			//initializeMap(reportLatitude,reportLongitude);
			map.setCenter(myLatlng); 
		}, 1);
	});
 

	// Numeric limitation on votes
	$("#votes").numeric({ decimalPlaces: 0, negative: true });


 
	// On city change, update types and subtypes
	$('#city').change(function() {
		var cityID = $(this).val();
		$('#type, #subtype').empty();
		if (typeof typesGrid[cityID] != "undefined") {
			for(var typeKey in typesGrid[cityID]) {
				var typeElement = '<option value="' + typeKey + '">' + typesGrid[cityID][typeKey]['name'] + '</option>';
				$('#type').append(typeElement);
			}
			var typeID = $('#type').val();
			for(var subtypeKey in typesGrid[cityID][typeID]['subtypes']) {
				var subtypeElement = '<option value="' + subtypeKey + '">' + typesGrid[cityID][typeID]['subtypes'][subtypeKey]['name'] + '</option>';
				$('#subtype').append(subtypeElement);
			}
		}
		cityID = parseInt(cityID);
		renderOtherCity(cityID);
	});



	// On type change, update subtypes
	$('#type').change(function() {
		var typeID = $(this).val();
		var cityID = $('#city').val();
		$('#subtype').empty();
		if (typeof typesGrid[cityID] != "undefined") {
			for(var subtypeKey in typesGrid[cityID][typeID]['subtypes']) {
				var subtypeElement = '<option value="' + subtypeKey + '">' + typesGrid[cityID][typeID]['subtypes'][subtypeKey]['name'] + '</option>';
				$('#subtype').append(subtypeElement);
			}
		}
	});



console.log(reportLatitude);
console.log(reportLongitude);

	// Initialize map on report center
	initializeMap(reportLatitude, reportLongitude);


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

	// Add marker for the report
	switch(reportStatus) {
		case 1:
			reportMarkerImage = {
				url: rootPath + '/img/modules/communalService/ch-report-in-progress.png',
				size: new google.maps.Size(54, 72),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(13, 35),
				scaledSize: new google.maps.Size(27, 36),
			};
		break;

		case 2:
			reportMarkerImage = {
				url: rootPath + '/img/modules/communalService/ch-report-done.png',
				size: new google.maps.Size(54, 72),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(13, 35),
				scaledSize: new google.maps.Size(27, 36),
			};
		break;

		case 3:
			reportMarkerImage = {
				url: rootPath + '/img/modules/communalService/ch-report-waiting.png',
				size: new google.maps.Size(54, 72),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(13, 35),
				scaledSize: new google.maps.Size(27, 36),
			};
		break;

		default:
			reportMarkerImage = {
				url: rootPath + '/img/modules/communalService/ch-report-in-progress.png',
				size: new google.maps.Size(54, 72),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(13, 35),
				scaledSize: new google.maps.Size(27, 36),
			};
	}
	reportMarker = new google.maps.Marker({
		position: new google.maps.LatLng(reportLatitude, reportLongitude),
		map: map,
		icon: reportMarkerImage,
		draggable: true,
		zIndex: 10
	});
	google.maps.event.addListener(reportMarker, 'dragend', function() {
		reportLatitude = reportMarker.getPosition().lat();
		reportLongitude = reportMarker.getPosition().lng();
		$('#reportLatitude').val(reportLatitude);
		$('#reportLongitude').val(reportLongitude);
	});



	// Don't render city if there isn't one
	if (citySelectedID != 0) {

		// Render city center
		cityMarker = new google.maps.Marker({
			position: new google.maps.LatLng(citiesData[citySelectedID].latitude, citiesData[citySelectedID].longitude),
			map: map,
			title: citiesData[citySelectedID].name,
			icon: cityCenterImage,
			zIndex: 5
		});
 
	}

});
