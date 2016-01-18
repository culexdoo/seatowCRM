<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	// Storage
	'storage' => 'Session',

	// Consumers
	'consumers' => array(

		// Facebook for MyCityHub app (older)
		/*'Facebook' => array(
			'client_id'			=>	'632096033557165',
			'client_secret'		=>	'3d31ab732d36ad8bbfbf51c7e4645b66',
			'scope'				=>	array('email'),
		),*/
	
		// Facebook for CityHub app
		'Facebook' => array(
			'client_id'			=>	'341384832723371',
			'client_secret'		=>	'57f0fbc403b11de7aa2b2a5df4a777f3',
			'scope'				=>	array('email'),
		),

		// Google
		'Google' => array(
			'client_id'			=>	'1089029585693-ofa42duse4er3q9d9t5u5s08dn1s1go5.apps.googleusercontent.com',
			'client_secret'		=>	'xrcyRRto2QN4Ff0jcslb1fR5',
			'scope'				=>	array('profile', 'email'),
		),
	)
);