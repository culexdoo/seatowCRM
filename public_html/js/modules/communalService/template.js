/*
*	CityHub - Communal service - Template add / edit
*/



$(document).ready(function(){
	// WYSIWYG editor on news content textarea
	$('#content').wysihtml5({
		"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": true, //Button to insert a link. Default true
		"image": true, //Button to insert an image. Default true,
		"color": false, //Button to change color of font
		"size": 'sm' //Button size like sm, xs etc.
	});
});
