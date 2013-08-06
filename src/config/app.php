<?php

return array(
	'aliases' 		=> array(
		'Basset'				=> 'Basset\Facade',
		'User' 					=> 'Justinhilles\Admin\Models\User',
		'Group' 				=> 'Justinhilles\Admin\Models\Group',
		'Permission'			=> 'Justinhilles\Admin\Models\Permission',
		'Sentry' 				=> 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'AdminController' 		=> 'Justinhilles\Admin\Controllers\Admin\AdminController',
		'AuthController' 		=> 'Justinhilles\Admin\Controllers\AuthController'
	),
	'providers' 	=> array(
		'Cartalyst\Sentry\SentryServiceProvider',
		'Basset\BassetServiceProvider'
	),
	'files'			=> array(
		__DIR__.'/../routes/routes.php',
		__DIR__.'/../filters.php'
	),
	'commands' 		=> array(
		'command.admin.install' => 'Justinhilles\Admin\Commands\AdminInstallCommand'
	),
);