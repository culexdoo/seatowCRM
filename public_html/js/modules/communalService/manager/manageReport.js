/*
*	CityHub - Communal Service - Manage report
*/



var map;
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
var reportMarkerImage;
var coordinates;
var reportLatitude;
var reportLongitude;



// Google Maps loading function
function initializeMap(reportLatitude, reportLongitude) {
	var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(reportLatitude, reportLongitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}



$(document).ready(function(){

 



	// Initialize map on report center
	initializeMap(reportLatitude, reportLongitude);


	coordinates = $('#coordinates').val();

	// Render city center
	cityMarker = new google.maps.Marker({
		position: new google.maps.LatLng(cityLatitude, cityLongitude),
		map: map,
		title: cityName,
		icon: cityCenterImage,
		zIndex: 5
	});

	$("#triggermap").on('click', function() {
		setTimeout(function(){
			google.maps.event.trigger(map, 'resize');
			//initializeMap(reportLatitude,reportLongitude);
			map.setCenter(myLatlng); 
		}, 1);
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
 


	// Add marker for the report
	reportStatus = parseInt(reportStatus);
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
		title: reportID,
		zIndex: 10
	});

});
