/*
*	CityHub - Communal service - My reports
*/



var map; 
var cityMarkers = {};
var cityCircles = {};
var reportMarkers = {};
var cityCenterImage = {
	url: rootPath + '/img/core/ch-city-center.png',
	size: new google.maps.Size(54, 72),
	origin: new google.maps.Point(0, 0),
	anchor: new google.maps.Point(13, 35),
	scaledSize: new google.maps.Size(27, 36),
};
var initialCityRendered = false;
var initialReportRendered = false;

var coordinates;


// Google Maps loading function
function initializeMap(mapLatitude, mapLongitude) {
	var mapOptions = {
		zoom: 10,
		center: new google.maps.LatLng(mapLatitude, mapLongitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}



// Focus on coordinates and bounce the marker
function focusCoordinates(markerID, reportLatitude, reportLongitude) {
	var newPosition = new google.maps.LatLng(reportLatitude, reportLongitude);
	map.setCenter(newPosition);
	reportMarkers[markerID].setAnimation(google.maps.Animation.BOUNCE);
	setTimeout(function() {
		reportMarkers[markerID].setAnimation(null);
	}, 700);
}



$(document).ready(function() {

	$("#showOnMapModal").on("shown.bs.modal", function () {
	    setTimeout(function() {
	    	google.maps.event.trigger(map, "resize");
	    	var centerInModal = new google.maps.LatLng(cityCenterLatitude, cityCenterLongitude);
	    	map.setCenter(centerInModal);
	    }, 500)
	});

	// Activate styling on admin note
	adminNote = $('#admin_note').wysihtml5({
		"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": true, //Button to insert a link. Default true
		"image": true, //Button to insert an image. Default true,
		"color": false, //Button to change color of font
		"size": 'sm' //Button size like sm, xs etc.
	});



	// Sort dropdown functionality
	$('.sort-dropdown').change(function(){
		var sortDate = $('#date').val();
		var sortPriority = $('#priority').val();
		var sortStatus = $('#status').val();
		var fullLink = currentLink + '/' + sortDate + '/' + sortPriority + '/' + sortStatus;
		window.location.assign(fullLink);
	});



	// Focus pin button functionality
	$('.focusButton').click(function(){
		var thisID = $(this).attr('data-id');
		var thisLatitude = $(this).attr('data-latitude');
		var thisLongitude = $(this).attr('data-longitude');

		focusCoordinates(thisID, thisLatitude, thisLongitude);
	});



	// Detail button functionality
	$('.detailButton').click(function(){
		var thisImageLink = $(this).attr('data-image');
		var thisDescription = $(this).attr('data-description');

		$('#modalReportImage').attr('src', thisImageLink);
		$('#modalReportText').text(thisDescription);
	});



	// Close detail modal window button functionality
	$('.modalCloseButton').click(function(){
		$('#modalReportImage').removeAttr('src');
		$('#modalReportText').text('');
	});



	// Render cities
	for(var key in citiesList) {

		// Initialize map based on first city
		if (initialCityRendered == false) {
			initializeMap(citiesList[key].latitude, citiesList[key].longitude);
			initialCityRendered = true;
		}
 
		// Initialize city markers
		cityMarkers[key] = new google.maps.Marker({
			position: new google.maps.LatLng(citiesList[key].latitude, citiesList[key].longitude),
			map: map,
			icon: cityCenterImage
		});



		coordinates = citiesList[key].coordinates; 

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
	}



	// Place reports
	for(var key in reportsList) {
		switch(reportsList[key].status) {
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



		// If map is not initialized, means no cities are there. Initialize map on first report.
		if (initialCityRendered == false) {
			initializeMap(reportsList[key].latitude, reportsList[key].longitude);
			initialCityRendered = true;
		}

		reportMarkers[key] = new google.maps.Marker({
			position: new google.maps.LatLng(reportsList[key].latitude, reportsList[key].longitude),
			map: map,
			icon: reportMarkerImage
		});

		google.maps.event.addListener(reportMarkers[key], 'click', function() {
			var reportDetailButton = '#report' + key + 'detailbutton';
			$(reportDetailButton).click();
		});
	}



	// If map is not initialized, means no cities are there. Initialize map on Geneva?
	if (initialCityRendered == false) {
		initializeMap(46.2050295, 6.1440885);
		initialCityRendered = true;
	}

});
