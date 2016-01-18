/*
*	CityHub - Communal Service - Overview
*/



var map;
var reportMarkers = {};
var cityCenterImage = {
	url: rootPath + '/img/core/ch-city-center.png',
	size: new google.maps.Size(54, 72),
	origin: new google.maps.Point(0, 0),
	anchor: new google.maps.Point(13, 35),
	scaledSize: new google.maps.Size(27, 36),
};



// Google Maps loading function
function initializeMap(latitude, longitude, radius, name) {
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(latitude, longitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);



	// Create first city marker
	var cityCenterMarker = new google.maps.Marker({
		position: new google.maps.LatLng(latitude, longitude),
		map: map,
		title: name,
		icon: cityCenterImage
	});



	// Set city circle
	var cityRadius = parseFloat(radius) * 1000;
	var cityRadiusCircle = new google.maps.Circle({
		strokeColor: '#d81f00',
		strokeOpacity: 0.5,
		strokeWeight: 1,
		fillColor: '#d81f00',
		fillOpacity: 0.20,
		map: map,
		center: new google.maps.LatLng(latitude, longitude),
		radius: cityRadius
	});
}



// Clear all modal content
function clearModalContent() {
	$('#reportImage').attr('src', '');
	$('.clearElement').empty();
	$('#userDescriptionSection, #adminNoteSection').show();
}



// Load report content into modal
function loadReport(id) {
	$('#reportImage').attr('src', dataReports[id].image);
	$('#reportID').html(dataReports[id].reportID);
	$('#reportCity').html(dataCityName);
	$('#reportType').html(dataReports[id].typeName);
	$('#reportSubtype').html(dataReports[id].subtypeName);
	$('#reportPriority').html(dataReports[id].priorityName);
	$('#reportStatus').html(dataReports[id].statusName);
	$('#reportVotes').html(dataReports[id].votes);

	if (dataReports[id].description == '') {
		$('#userDescriptionSection').hide();
	} else {
		$('#reportDescription').html(dataReports[id].description);
	}

	if (dataReports[id].adminNote == '') {
		$('#adminNoteSection').hide();
	} else {
		$('#reportAdminNote').html(dataReports[id].adminNote);
	}

	$('#reportDateTime').html(dataReports[id].createdAt);

	$('.custom-modal').show().attr('data-status', 'on');
}



$(document).ready(function(){

	// Set the map and city
	initializeMap(dataCityCenterLatitude, dataCityCenterLongitude, dataCityRadius, dataCityName);



	// Close modal button functionality
	$('.custom-modal-close-button').click(function(){
		$('.custom-modal').fadeOut(500, function(){
			clearModalContent();
			$('.custom-modal').attr('data-status', 'off');
		});
	});



	// Place reports
	for(var key in dataReports) {
		switch(dataReports[key].statusID) {
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

		reportMarkers[key] = new google.maps.Marker({
			position: new google.maps.LatLng(dataReports[key].latitude, dataReports[key].longitude),
			map: map,
			icon: reportMarkerImage,
			title: key
		});

		google.maps.event.addListener(reportMarkers[key], 'click', function() {
			var id = parseInt(this.getTitle());
			loadReport(id);
		});
	}
});
