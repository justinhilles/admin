<?php

return array(
	'commands' => array(
		'command.admin.install' => 'Justinhilles\Admin\Commands\AdminInstallCommand'
	),
	'aliases' => array(
		'Basset'				=> 'Basset\Facade',
		'User' 					=> 'Justinhilles\Admin\Models\User',
		'Group' 				=> 'Justinhilles\Admin\Models\Group',
		'Permission'			=> 'Justinhilles\Admin\Models\Permission',
		'Sentry' 				=> 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'AdminController' 		=> 'Justinhilles\Admin\Controllers\Admin\AdminController',
		'AuthController' 		=> 'Justinhilles\Admin\Controllers\AuthController'
	),
	'providers' => array(
		'Cartalyst\Sentry\SentryServiceProvider',
		'Basset\BassetServiceProvider'
	),
);