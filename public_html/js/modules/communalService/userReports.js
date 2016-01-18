/*
*	CityHub - Communal Service - User reports
*/



var map;
var cityMarkers = {};
var cityCircles = {};
var reportMarkers = {};
var delegateData;
var adminNote;



// Google Maps loading function
function initializeMap(mapLatitude, mapLongitude) {
	var mapOptions = {
		zoom: 12,
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



	// Templates drop down functionality
	$('#template_id').change(function(){
		var thisID = parseInt($(this).val());
		$.each(delegateData.templates, function(index,value){
			if (thisID == index){
				var $ta = $('#admin_note');
				var w5ref = $ta.data('wysihtml5');
				if(w5ref) {
					w5ref.editor.setValue(value.content);
				} else {
					$ta.html(value.content);
				}
			}
		});
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
				'_token': $('#token').val(),
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



	// Delegate button click
	$('.delegateButton').click(function(){
		var thisCity = $(this).attr('data-city');
		var thisReport = $(this).attr('data-id');

		var loadCityCompanies = $.ajax({
			url: delegationDataLink,
			dataType: 'json',
			data: {
				'_token': $('#token').val(),
				'city': thisCity,
			},
			type: 'post',
		}).done(function(data) {
			if (data.status == '1') {
				delegateData = data;
				// load elements into select
				$('#company_id').empty();
				$.each(data.companies, function(index,value){
					var optionElement = '<option value="' + index + '">' + value + '</option>';
					$('#company_id').append(optionElement);
				});
				$('template_id').empty();
				var isSet = false;
				var counter = 0;
				$.each(data.templates, function(index,value){
					counter++;
					var optionElement = '<option value="' + index + '">' + value.name + '</option>';
					$('#template_id').append(optionElement);
					if (isSet == false)
					{
						var $ta = $('#admin_note');
						var w5ref = $ta.data('wysihtml5');
						if(w5ref) {
							w5ref.editor.setValue(value.content);
						} else {
							$ta.html(value.content);
						}
						isSet = true;
					}
				});
				$('#doTheDelegate').attr('data-report', thisReport);
				$('.delegateFormElement').removeAttr('disabled');
				if (counter == 0)
				{
					$('#template_id').attr('disabled', 'disabled');
				}
			} else {
				var n = noty({
					text: lang_delegate_error,
					type: 'error',
					theme: 'cityhub',
					layout: 'bottomRight',
					animation: {
						open: 'animated bounceInUp',
						close: 'animated bounceOutDown',
					}
				});
			}
		}).fail(function(data) {
			var n = noty({
				text: lang_delegate_error,
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



	// Delegate button functionality
	$('#doTheDelegate').click(function() {
		var reportID = $(this).attr('data-report');
		var companyID = $('#company_id').val();
		var companyIdentifier = '#company_id option[value="' + companyID + '"]';
		companyIdentifier = $(companyIdentifier).text();
		var priorityID = $('#priority_modal_id').val();
		var priorityIdentifier = '#priority_modal_id option[value="' + priorityID + '"]';
		priorityIdentifier = $(priorityIdentifier).text();
		var noteContent = $('#admin_note').val();
		var reportPriorityDisplay = '#report' + reportID + 'prioritydisplay';
		var reportDelegatedTo = '#report' + reportID + 'delegatedto';
		if (reportID != '') {
			$('.delegateFormElement').attr('disabled', 'disabled');
			var loadCityCompanies = $.ajax({
				url: delegateLink,
				dataType: 'json',
				data: {
					'_token': $('#token').val(),
					'report': reportID,
					'company': companyID,
					'priority': priorityID,
					'note': noteContent
				},
				type: 'post',
			}).done(function(data) {
				if (data.status == '1') {
					var n = noty({
						text: lang_delegate_set_success,
						type: 'success',
						theme: 'cityhub',
						layout: 'bottomRight',
						animation: {
							open: 'animated bounceInUp',
							close: 'animated bounceOutDown',
						}
					});
					$(reportPriorityDisplay).text(priorityIdentifier);
					$(reportDelegatedTo).text(companyIdentifier);
				} else {
					var n = noty({
						text: lang_delegate_set_error,
						type: 'error',
						theme: 'cityhub',
						layout: 'bottomRight',
						animation: {
							open: 'animated bounceInUp',
							close: 'animated bounceOutDown',
						}
					});
				}
				$('.delegateFormElement').removeAttr('disabled');
			}).fail(function(data) {
				var n = noty({
					text: lang_delegate_set_error,
					type: 'error',
					theme: 'cityhub',
					layout: 'bottomRight',
					animation: {
						open: 'animated bounceInUp',
						close: 'animated bounceOutDown',
					}
				});
				$('.delegateFormElement').removeAttr('disabled');
			});
		}
	});



	// Close delegate modal window
	$('.modalDelegateCloseButton').click(function() {
		$('#company_id').empty();
		$('#doTheDelegate').attr('data-report', '');
		delegateData = null;
		$('.delegateFormElement').attr('disabled', 'disabled');
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



	// Set city marker image
	var cityCenterImage = {
		url: rootPath + '/img/core/ch-city-center.png',
		size: new google.maps.Size(54, 72),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(13, 35),
		scaledSize: new google.maps.Size(27, 36),
	};



	// Set all city markers
	var firstCitySet = false;
	for(var key in citiesList) {
		if (firstCitySet == false)
		{
			initializeMap(citiesList[key].latitude, citiesList[key].longitude);
			firstCitySet = true;
		}
		cityMarkers[key] = new google.maps.Marker({
			position: new google.maps.LatLng(citiesList[key].latitude, citiesList[key].longitude),
			map: map,
			icon: cityCenterImage,
			title: citiesList[key].name
		});

		// Set city circle
		var cityRadius = parseFloat(citiesList[key].radius) * 1000;
		cityCircles[key] = new google.maps.Circle({
			strokeColor: '#d81f00',
			strokeOpacity: 0.5,
			strokeWeight: 1,
			fillColor: '#d81f00',
			fillOpacity: 0.20,
			map: map,
			center: new google.maps.LatLng(citiesList[key].latitude, citiesList[key].longitude),
			radius: cityRadius
		});
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

});
