<?php

return array(
	'prefix' => 'admin',
	'title' => 'Admin',
	'per_page' => 10,
	'commands' => array(
		'command.admin.install' => 'Justinhilles\Admin\Commands\AdminInstallCommand'
	),
	'aliases' => array(
		'User' 		=> 'Justinhilles\Admin\Models\User',
		'Group' 		=> 'Justinhilles\Admin\Models\Group',
		'Permission'=> 'Justinhilles\Admin\Models\Permission',
		'Sentry' 	=> 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'AdminController' => 'Justinhilles\Admin\Controllers\Admin\AdminController',
		'AuthController' => 'Justinhilles\Admin\Controllers\AuthController'
	),
	'providers' => array(
		'Cartalyst\Sentry\SentryServiceProvider',
		'Basset\BassetServiceProvider'
	),
	'stylesheets' => array(
		'//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css',
		'//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css',
		'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css'
	),
	'javascripts' => array(
		'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
		'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'
	)
);