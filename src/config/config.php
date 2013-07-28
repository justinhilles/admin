<?php

return array(
	'prefix' 			=> 'admin',
	'title' 			=> 'Admin',
	'per_page' 			=> 10,
	'collection' 		=> 'admin',
	'stylesheets' 		=> array(
		'//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css',
		'//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css',
		'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css',
		__DIR__.'/../../public/assets/stylesheets/admin.css'
	),
	'javascripts' 		=> array(
		'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
		'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'
	)
);