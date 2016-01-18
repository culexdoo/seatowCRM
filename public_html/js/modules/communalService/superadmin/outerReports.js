/*
*	CityHub - outer reports
*/



var map;
var cityCenterImage = {
	url: rootPath + '/img/core/ch-city-center.png',
	size: new google.maps.Size(54, 72),
	origin: new google.maps.Point(0, 0),
	anchor: new google.maps.Point(13, 35),
	scaledSize: new google.maps.Size(27, 36),
};
var reportMarkers = {};
var cityMarkers = {};
var cityCircles = {};

var coordinates;



// Google Maps loading function
function initializeMap(mapLatitude, mapLongitude) {
	var mapOptions = {
		zoom: 8,
		center: new google.maps.LatLng(46, 15)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

$("#showOnMapModal").on("shown.bs.modal", function () {
    setTimeout(function() {
    	google.maps.event.trigger(map, "resize");
    	var centerInModal = new google.maps.LatLng(cityCenterLatitude, cityCenterLongitude);
    	map.setCenter(centerInModal);
    }, 500)
});


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



	// Click on assign button
	$('.assignButton').click(function() {
		var thisReport = $(this).attr('data-report');
		$('#report_id').val(thisReport);
	});



	// Change city in assign modal
	$('#city_id').change(function() {
		var thisValue = $(this).val();
		$('#type_id, #subtype_id').empty();
		for(var key in types[thisValue]) {
			var optionHtml = '<option value="' + key + '">' + types[thisValue][key] + '</option>';
			$('#type_id').append(optionHtml);
			for(var key2 in subtypes[key]) {
				var optionHtml2 = '<option value="' + key2 + '">' + subtypes[key][key2] + '</option>';
				$('#subtype_id').append(optionHtml2);
			}
		}
	});



	// Change type id in assign modal
	$('#type_id').change(function() {
		var thisValue = $(this).val();
		$('#subtype_id').empty();
		for(var key in subtypes[thisValue]) {
			var optionHtml = '<option value="' + key + '">' + subtypes[thisValue][key] + '</option>';
			$('#subtype_id').append(optionHtml);
		}
	});



	// Delete button functionality
	$('.button-delete-report').click(function(event){
		var reportID = $(this).attr('data-id');
		var fullText = lang_confirm_delete_text.replace('***', reportID);
		var confirmDelete = confirm(fullText);
		if (confirmDelete == false) {
			event.preventDefault();
		}
	});



	// Activate report button functionality (AJAX)
	$('.activateButton').click(function() {
		var thisElement = $(this);
		var thisID = $(this).attr('data-id');
		var thisStatus = $(this).attr('data-status');
		var thisMarkerColor = '#report' + thisID + 'active';
		var thisMarkerIcon = '#report' + thisID + 'activeicon';

		thisElement.removeClass('btn-danger btn-success').addClass('btn-default').attr('disabled', 'disabled');

		if (thisStatus == 'true') {
			var reportAjaxLink = report_deactivate_link;
			var reportTooltip = lang_deactivate_tooltip;
		} else {
			var reportAjaxLink = report_activate_link;
			var reportTooltip = lang_activate_tooltip;
		}

		var loadUsers = $.ajax({
			url: reportAjaxLink,
			dataType: 'json',
			data: {
				'_token': token,
				'id': thisID,
			},
			type: 'post',
		}).done(function(data) {
			if (data.status == 1) {
				if (thisStatus == 'true') {
					thisElement.removeClass('btn-default').addClass('btn-success');
					thisElement.find('span').removeClass('icon-highlight-remove').addClass('icon-done-all');
					$(thisMarkerColor).removeClass('text-success').addClass('text-danger');
					$(thisMarkerIcon).removeClass('icon-done').addClass('icon-close').attr('title', lang_tooltip_inactive);
					thisElement.attr('data-status', 'false');
					thisElement.attr('title', lang_activate_tooltip);
				} else {
					thisElement.removeClass('btn-default').addClass('btn-danger');
					thisElement.find('span').removeClass('icon-done-all').addClass('icon-highlight-remove');
					$(thisMarkerColor).removeClass('text-danger').addClass('text-success');
					$(thisMarkerIcon).removeClass('icon-close').addClass('icon-done').attr('title', lang_tooltip_active);
					thisElement.attr('data-status', 'true');
					thisElement.attr('title', lang_deactivate_tooltip);
				}
			} else {
				if (thisStatus == 'true') {
					thisElement.removeClass('btn-default').addClass('btn-danger');
				} else {
					thisElement.removeClass('btn-default').addClass('btn-success');
				}
				var n = noty({
					text: lang_activate_error,
					type: 'error',
					theme: 'cityhub',
					layout: 'bottomRight',
					animation: {
						open: 'animated bounceInUp',
						close: 'animated bounceOutDown',
					}
				});
			}
			thisElement.removeAttr('disabled');
		}).fail(function(data) {
			var n = noty({
				text: lang_activate_error,
				type: 'error',
				theme: 'cityhub',
				layout: 'bottomRight',
				animation: {
					open: 'animated bounceInUp',
					close: 'animated bounceOutDown',
				}
			});
		});
	});



	// Initialize map
	var reportsCount = 0;
	for(var key in reports) {
		if (reportsCount == 0) {
			initializeMap(reports[key].latitude, reports[key].longitude);
		}
		reportsCount += 1;
	}



	// Place active cities
	var citiesCount = 0;
	for(var key in cities) {
		// Create city marker
		cityCenterMarker = new google.maps.Marker({
			position: new google.maps.LatLng(cities[key].latitude, cities[key].longitude),
			map: map,
			title: cities[key].name,
			icon: cityCenterImage
		});
  
		coordinates = cities[key].coordinates; 

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
	for(var key in reports) {
		switch(reports[key].status) {
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
			position: new google.maps.LatLng(reports[key].latitude, reports[key].longitude),
			map: map,
			icon: reportMarkerImage
		});
		google.maps.event.addListener(reportMarkers[key], 'click', function() {
			var reportDetailButton = '#report' + key + 'detailbutton';
			$(reportDetailButton).click();
		});
	}
 
});