/*
*	CityHub - CityNews edit news 
*/

/* Create one polygon for city, and another for city_news, no more "One polygon to rule them all"*/

var map;
var centerLatitude;
var centerLongitude;
var cityName;
var alternateCityName;
var cityCenterMarker;
var newMarkerLatitude;
var newMarkerLongitude;  
var newsCenterMarker;
var newsCenterMarkerSet = false; 
var oldCity;
var cityCenterImage;
var newsCenterImage;
var city_news_coordinates;
var city_coordinates; 
 

// Google Maps loading function
function initializeMap(mapLatitude, mapLongitude) {
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(mapLatitude, mapLongitude)
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
} 

//Display Coordinates 

function getPolygonCoords() {
  var len = myPolygon.getPath().getLength();
  var htmlStr = "";
  for (var i = 0; i < len; i++) {
    //Use this one if you want to get the wrap > new google.maps.LatLng(), 
    //htmlStr += "new google.maps.LatLng(" + myPolygon.getPath().getAt(i).toUrlValue(5) + "),<br>";
    //htmlStr += "new google.maps.LatLng(' + myPolygon.getPath().getAt(i).toUrlValue(5) +'),";

    //Use this one instead if you want to get rid of the wrap > new google.maps.LatLng(),
     htmlStr += myPolygon.getPath().getAt(i).toUrlValue(5) + ";";
  }
  document.getElementById('city_news_coordinates').value = htmlStr;
}

function getNewsPolygonCoords() {
  var len = newsPolygon.getPath().getLength();
  var htmlStr = "";
  for (var i = 0; i < len; i++) {
    //Use this one if you want to get the wrap > new google.maps.LatLng(), 
    //htmlStr += "new google.maps.LatLng(" + newsPolygon.getPath().getAt(i).toUrlValue(5) + "),<br>";
    //htmlStr += "new google.maps.LatLng(' + newsPolygon.getPath().getAt(i).toUrlValue(5) +'),";

    //Use this one instead if you want to get rid of the wrap > new google.maps.LatLng(),
     htmlStr += newsPolygon.getPath().getAt(i).toUrlValue(5) + ";";
  }
  document.getElementById('city_news_coordinates').value = htmlStr;
}


// Reset new city
function resetNewCity() {

	// Get value to draw polygons city
	var firstCompany = $('#company_id').val();
	var firstCityData = citiesData[firstCompany];
	oldCity = citiesData[firstCompany].cityID; 

 
	// Initialize the map on first city
	initializeMap(firstCityData.cityLatitude, firstCityData.cityLongitude);
 
	// Create city marker image
	cityCenterImage = {
		url: rootPath + '/img/core/ch-city-center.png',
		size: new google.maps.Size(54, 72),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(13, 35),
		scaledSize: new google.maps.Size(27, 36),
	};


	// Create first city marker
	cityCenterMarker = new google.maps.Marker({
		position: new google.maps.LatLng(firstCityData.cityLatitude, firstCityData.cityLongitude),
		map: map,
		icon: cityCenterImage,
		title: firstCityData.cityName,
	});



	city_coordinates = firstCityData.cityCoordinates;

	var city_coordinates_array; 	
    city_coordinates_array = city_coordinates.split(";");
   	city_coordinates_array.pop();
    
    var paths = [];
    var coordsArr = [];
    for(i=0; i<city_coordinates_array.length; i++) {
    	coordsArr = city_coordinates_array[i].split(',');
    	paths.push(new google.maps.LatLng(coordsArr[0], coordsArr[1]));
    	//console.log(city_coordinates_array[i]);
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
	    fillOpacity: 0.15
	  });

	  myPolygon.setMap(map);



	// Add listener to city radius circle to create news center marker
	var newsMarkerListener = google.maps.event.addListener(myPolygon, 'click', function(event) {

		// Mark as marker done
		newsCenterMarkerSet = true;

		// Get click location
		var newLocation = event.latLng;



		// News maker icon
		newsCenterImage = {
			url: rootPath + '/img/modules/cityNews/ch-city-news-item.png',
			size: new google.maps.Size(54, 72),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(13, 35),
			scaledSize: new google.maps.Size(27, 36),
		};



		// Make the marker and center it
		newsCenterMarker = new google.maps.Marker({
			position: newLocation,
			map: map,
			icon: newsCenterImage,
			draggable: true
		});
		map.setCenter(newLocation);



		// Set the values of center marker to fields
		centerLatitude = newsCenterMarker.getPosition().lat();
		centerLongitude = newsCenterMarker.getPosition().lng();
		$('#centerLatitude, #center_latitude').val(centerLatitude);
		$('#centerLongitude, #center_longitude').val(centerLongitude);

 		//Make starting polygon from values
 
	      var dummyObject = {A: 0, F: 0};
	      var i = 0;
	      $.each(newLocation,function(key,value){ 
	        if(i == 1) {dummyObject.F = value;}
	        else if (!i) {dummyObject.A = value;}
	        i++;
	      });
 

	      //   news_coordinates around marker
	      var coordinate_lat_1 = dummyObject.A-0.0025;
	      var coordinate_lon_1 = dummyObject.F-0.0025;

	      var coordinate_lat_2 = dummyObject.A-0.0025;
	      var coordinate_lon_2 = dummyObject.F+0.0025;

	      var coordinate_lat_3 = dummyObject.A-0.0025;
	      var coordinate_lon_3 = dummyObject.F+0.0025;

	      var coordinate_lat_4 = dummyObject.A+0.0025;
	      var coordinate_lon_4 = dummyObject.F+0.0025;

	      var coordinate_lat_5 = dummyObject.A+0.0025;
	      var coordinate_lon_5 = dummyObject.F+0.0025;

	      var coordinate_lat_6 = dummyObject.A+0.0025;
	      var coordinate_lon_6 = dummyObject.F-0.0025;      

	      // Polygon news_coordinates 
	      // Create demo news_coordinates around pin

	      var startCoords = [
	        new google.maps.LatLng(coordinate_lat_1,coordinate_lon_1),
	        new google.maps.LatLng(coordinate_lat_2,coordinate_lon_2),
	        new google.maps.LatLng(coordinate_lat_3,coordinate_lon_3),
	        new google.maps.LatLng(coordinate_lat_4,coordinate_lon_4),
	        new google.maps.LatLng(coordinate_lat_5,coordinate_lon_5),
	        new google.maps.LatLng(coordinate_lat_6,coordinate_lon_6)
	      ];
	  
	      // Styling & Controls
	      newsPolygon = new google.maps.Polygon({
	        paths: startCoords,
	        draggable: true, // turn off if it gets annoying
	        editable: true,
		    strokeColor: '#388E3C',
		    strokeOpacity: 0.8,
		    strokeWeight: 2,
		    fillColor: '#4CAF50',
	        fillOpacity: 0.40
	      });

	      newsPolygon.setMap(map);

	      google.maps.event.addListener(newsPolygon.getPath(), "insert_at", getNewsPolygonCoords);
	      google.maps.event.addListener(newsPolygon.getPath(), "set_at", getNewsPolygonCoords);
	     
	      //Fallback if we don't set city_news_coordinates
	      city_news_coordinates = $('#city_news_coordinates').val();

	      if (city_news_coordinates == '') { 
	        google.maps.event.addListener(map, 'click', getNewsPolygonCoords());
	      }
    
		// Set city_coordinates and get city_coordinates after dropping city center marker
		google.maps.event.addListener(newsCenterMarker, 'dragend', function() {
			newMarkerLatitude = newsCenterMarker.getPosition().lat();
			newMarkerLongitude = newsCenterMarker.getPosition().lng();
			$('#centerLatitude, #center_latitude').val(newMarkerLatitude);
			$('#centerLongitude, #center_longitude').val(newMarkerLongitude); 
		});  

		// Remove listener to prevent multiple centers
		google.maps.event.removeListener(newsMarkerListener);
	});

}



$(document).ready(function() {

	// Datepickers on start and end date
	$("#news_start, #news_end").datetimepicker();



	// WYSIWYG editor on news content textarea
	$('.news_content').wysihtml5({
		"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": true, //Button to insert a link. Default true
		"image": true, //Button to insert an image. Default true,
		"color": false, //Button to change color of font
		"size": 'sm' //Button size like sm, xs etc.
	});

 
	// Get current values
	centerLatitude = $('#centerLatitude').val();
	centerLongitude = $('#centerLongitude').val();  
	city_news_coordinates = $('#city_news_coordinates').val();
  
  	if (city_news_coordinates != '') {

		// Get value in select to create first city
		var firstCompany = $('#company_id').val();
		var firstCityData = citiesData[firstCompany];
		oldCity = citiesData[firstCompany].cityID;



		// Initialize the map on first city
		initializeMap(firstCityData.cityLatitude, firstCityData.cityLongitude);



		// Create city marker image
		cityCenterImage = {
			url: rootPath + '/img/core/ch-city-center.png',
			size: new google.maps.Size(54, 72),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(13, 35),
			scaledSize: new google.maps.Size(27, 36),
		};
	 

		// Create first city marker
		cityCenterMarker = new google.maps.Marker({
			position: new google.maps.LatLng(firstCityData.cityLatitude, firstCityData.cityLongitude),
			map: map,
			icon: cityCenterImage,
			title: firstCityData.cityName,
		});


			//Create polygon for city
			city_coordinates = firstCityData.cityCoordinates;

			var city_coordinates_array; 	
		    city_coordinates_array = city_coordinates.split(";");
		   	city_coordinates_array.pop();
		    
		    var paths = [];
		    var coordsArr = [];
		    for(i=0; i<city_coordinates_array.length; i++) {
		    	coordsArr = city_coordinates_array[i].split(',');
		    	paths.push(new google.maps.LatLng(coordsArr[0], coordsArr[1]));
		    	//console.log(city_coordinates_array[i]);
		    }

			  // Styling & Controls
			  myPolygon = new google.maps.Polygon({
			    paths: paths,
			    draggable: false, // turn off if it gets annoying
			    editable: false,
			    strokeColor: '#FF0000',
			    strokeOpacity: 0.35,
			    strokeWeight: 2,
			    fillColor: '#FF0000',
			    fillOpacity: 0.15
			  });

			  myPolygon.setMap(map);

		//Create polygon for news
		news_coordinates = city_news_coordinates;

		var news_coordinates_array; 	
	    news_coordinates_array = news_coordinates.split(";");
	   	news_coordinates_array.pop();
	    
	    var news_coordinates_paths = [];
	    var news_coordsArr = [];
	    for(i=0; i<news_coordinates_array.length; i++) {
	    	news_coordsArr = news_coordinates_array[i].split(',');
	    	news_coordinates_paths.push(new google.maps.LatLng(news_coordsArr[0], news_coordsArr[1]));
	    	//console.log(news_coordinates_array[i]);
	    }

	    // Styling & Controls
		  newsPolygon = new google.maps.Polygon({
		    paths: news_coordinates_paths,
		    draggable: true, // turn off if it gets annoying
		    editable: true,
		    strokeColor: '#388E3C',
		    strokeOpacity: 0.8,
		    strokeWeight: 2,
		    fillColor: '#4CAF50',
		    fillOpacity: 0.15
		  });

	  	newsPolygon.setMap(map);

		  google.maps.event.addListener(newsPolygon, "dragend", getNewsPolygonCoords);
		  google.maps.event.addListener(newsPolygon.getPath(), "insert_at", getNewsPolygonCoords);
		  google.maps.event.addListener(newsPolygon.getPath(), "remove_at", getNewsPolygonCoords);
		  google.maps.event.addListener(newsPolygon.getPath(), "set_at", getNewsPolygonCoords);
	 
	 
		// News maker icon
		newsCenterImage = {
			url: rootPath + '/img/modules/cityNews/ch-city-news-item.png',
			size: new google.maps.Size(54, 72),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(13, 35),
			scaledSize: new google.maps.Size(27, 36),
		};

	 
		// Make the marker and center it
		newsCenterMarker = new google.maps.Marker({
			position: new google.maps.LatLng(centerLatitude, centerLongitude),
			map: map,
			icon: newsCenterImage,
			draggable: true
		});
		map.setCenter(new google.maps.LatLng(centerLatitude, centerLongitude));

	 
		// Redraw circle and get city_coordinates after dropping city center marker
		google.maps.event.addListener(newsCenterMarker, 'dragend', function() {
			newMarkerLatitude = newsCenterMarker.getPosition().lat();
			newMarkerLongitude = newsCenterMarker.getPosition().lng();
			$('#centerLatitude, #center_latitude').val(newMarkerLatitude);
			$('#centerLongitude, #center_longitude').val(newMarkerLongitude); 
		});
 
  	} else {
  
	// Get value in select to create first city
	var firstCompany = $('#company_id').val();
	var firstCityData = citiesData[firstCompany];
	oldCity = citiesData[firstCompany].cityID;
 
	// Initialize the map on first city
	initializeMap(firstCityData.cityLatitude, firstCityData.cityLongitude);
 
	// Create city marker image
	cityCenterImage = {
		url: rootPath + '/img/core/ch-city-center.png',
		size: new google.maps.Size(54, 72),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(13, 35),
		scaledSize: new google.maps.Size(27, 36),
	};
 

	// Create first city marker
	cityCenterMarker = new google.maps.Marker({
		position: new google.maps.LatLng(firstCityData.cityLatitude, firstCityData.cityLongitude),
		map: map,
		icon: cityCenterImage,
		title: firstCityData.cityName,
	});
 

	city_coordinates = firstCityData.cityCoordinates;

	var city_coordinates_array; 	
    city_coordinates_array = city_coordinates.split(";");
   	city_coordinates_array.pop();
    
    var paths = [];
    var coordsArr = [];
    for(i=0; i<city_coordinates_array.length; i++) {
    	coordsArr = city_coordinates_array[i].split(',');
    	paths.push(new google.maps.LatLng(coordsArr[0], coordsArr[1]));
    	//console.log(city_coordinates_array[i]);
    }

	  // Styling & Controls
	  myPolygon = new google.maps.Polygon({
	    paths: paths,
	    draggable: false, // turn off if it gets annoying
	    editable: false,
	    strokeColor: '#FF0000',
	    strokeOpacity: 0.35,
	    strokeWeight: 2,
	    fillColor: '#FF0000',
	    fillOpacity: 0.15
	  });

	  myPolygon.setMap(map);


	var newsMarkerListener = google.maps.event.addListener(myPolygon, 'click', function(event) {

			// Mark as marker done
			newsCenterMarkerSet = true;

			// Get click location
			var newLocation = event.latLng;
	  
			// News maker icon
			newsCenterImage = {
				url: rootPath + '/img/modules/cityNews/ch-city-news-item.png',
				size: new google.maps.Size(54, 72),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(13, 35),
				scaledSize: new google.maps.Size(27, 36),
			};
	 
			// Make the marker and center it
			newsCenterMarker = new google.maps.Marker({
				position: newLocation,
				map: map,
				icon: newsCenterImage,
				draggable: true
			});
			map.setCenter(newLocation);
	 

			// Set the values of center marker to fields
			centerLatitude = newsCenterMarker.getPosition().lat();
			centerLongitude = newsCenterMarker.getPosition().lng();
			$('#centerLatitude, #center_latitude').val(centerLatitude);
			$('#centerLongitude, #center_longitude').val(centerLongitude);
	 
			//Make starting polygon from values
	 
		      var dummyObject = {A: 0, F: 0};
		      var i = 0;
		      $.each(newLocation,function(key,value){ 
		        if(i == 1) {dummyObject.F = value;}
		        else if (!i) {dummyObject.A = value;}
		        i++;
		      });
	 

		      // Demo coordinates around marker
		      var coordinate_lat_1 = dummyObject.A-0.0025;
		      var coordinate_lon_1 = dummyObject.F-0.0025;

		      var coordinate_lat_2 = dummyObject.A-0.0025;
		      var coordinate_lon_2 = dummyObject.F+0.0025;

		      var coordinate_lat_3 = dummyObject.A-0.0025;
		      var coordinate_lon_3 = dummyObject.F+0.0025;

		      var coordinate_lat_4 = dummyObject.A+0.0025;
		      var coordinate_lon_4 = dummyObject.F+0.0025;

		      var coordinate_lat_5 = dummyObject.A+0.0025;
		      var coordinate_lon_5 = dummyObject.F+0.0025;

		      var coordinate_lat_6 = dummyObject.A+0.0025;
		      var coordinate_lon_6 = dummyObject.F-0.0025;      

		      // Polygon Coordinates 
		      // Create demo coordinates around pin

		      var startCoords = [
		        new google.maps.LatLng(coordinate_lat_1,coordinate_lon_1),
		        new google.maps.LatLng(coordinate_lat_2,coordinate_lon_2),
		        new google.maps.LatLng(coordinate_lat_3,coordinate_lon_3),
		        new google.maps.LatLng(coordinate_lat_4,coordinate_lon_4),
		        new google.maps.LatLng(coordinate_lat_5,coordinate_lon_5),
		        new google.maps.LatLng(coordinate_lat_6,coordinate_lon_6)
		      ];
		  
		      // Styling & Controls
		      newsPolygon = new google.maps.Polygon({
		        paths: startCoords,
		        draggable: true, // turn off if it gets annoying
		        editable: true,
			    strokeColor: '#388E3C',
			    strokeOpacity: 0.8,
			    strokeWeight: 2,
			    fillColor: '#4CAF50',
		        fillOpacity: 0.40
		      });

		      newsPolygon.setMap(map);

		      google.maps.event.addListener(newsPolygon.getPath(), "insert_at", getNewsPolygonCoords);
		      google.maps.event.addListener(newsPolygon.getPath(), "set_at", getNewsPolygonCoords);
		     
		      //Fallback if we don't set city_news_coordinates
		      city_news_coordinates = $('#city_news_coordinates').val();

		      if (city_news_coordinates == '') { 
		        google.maps.event.addListener(map, 'click', getNewsPolygonCoords());
		      }
	    
	  
			// Redraw polygon and get city_news_coordinates after dropping city center marker
			google.maps.event.addListener(newsCenterMarker, 'dragend', function() {
				newMarkerLatitude = newsCenterMarker.getPosition().lat();
				newMarkerLongitude = newsCenterMarker.getPosition().lng();
				$('#centerLatitude, #center_latitude').val(newMarkerLatitude);
				$('#centerLongitude, #center_longitude').val(newMarkerLongitude); 
			}); 

			// Remove listener to prevent multiple centers
			google.maps.event.removeListener(newsMarkerListener);
		});
  
  	}

	// Reset city settings on change company (city company change)
	$('#company_id').change(function() {
		var newCity = $(this).val();

		if (oldCity != newCity) {

			// Delete all values
			cityCenterMarker.setMap(null);
			myPolygon.setMap(null);
			if (newsCenterMarkerSet == true) {
				newsCenterMarker.setMap(null);
 				newsCenterMarkerSet = false;
			}
			$('#centerLatitude, #center_latitude, #centerLongitude, #center_longitude').val('');
			$('#city_coordinates').val('');

			resetNewCity();

			oldCity = newCity;
		}
	});

});
