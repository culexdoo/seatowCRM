/*
*	CityHub - Communal Service - Report details
*/



var map;
var cityCenterLatitude;
var cityCenterLongitude;
var cityCenterImage;
var cityCenterMarker; 
var reportMarker;
var reportMarkerImage;
var coordinates;



$(document).ready(function() {

	// Load the map centered on report
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(report_latitude, report_longitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);



	// Create city marker image
	cityCenterImage = {
		url: rootPath + '/img/core/ch-city-center.png',
		size: new google.maps.Size(54, 72),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(13, 35),
		scaledSize: new google.maps.Size(27, 36),
	};



	// Create city marker
	cityCenterMarker = new google.maps.Marker({
		position: new google.maps.LatLng(city_latitude, city_longitude),
		map: map,
		icon: cityCenterImage,
		zIndex: 1
	});
 

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


	// Choose marker image
	switch(parseInt(report_status)) {
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



	// Draw the report marker
	reportMarker = new google.maps.Marker({
		position: new google.maps.LatLng(report_latitude, report_longitude),
		map: map,
		icon: reportMarkerImage,
		zIndex: 2
	});

});
