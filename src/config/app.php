<?php

return array(
	'aliases' 		=> array(
		'Admin'					=> 'Justinhilles\Admin\Facades\Admin',
		'Basset'				=> 'Basset\Facade',
		'User' 					=> 'Justinhilles\Admin\Models\User',
		'Group' 				=> 'Justinhilles\Admin\Models\Group',
		'Permission'			=> 'Justinhilles\Admin\Models\Permission',
		'Sentry' 				=> 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'AdminController' 		=> 'Justinhilles\Admin\Controllers\Admin\AdminController',
		'AuthController' 		=> 'Justinhilles\Admin\Controllers\AuthController'
	),
	'config'	=> array(
		'cartalyst/sentry::users.model' => 'Justinhilles\Admin\Models\User',
		'cartalyst/sentry::groups.model' => 'Justinhilles\Admin\Models\Group'
	),
	'providers' 	=> array(
		'Cviebrock\EloquentSluggable\SluggableServiceProvider',
		'Cartalyst\Sentry\SentryServiceProvider',
		'Basset\BassetServiceProvider'
	),
	'observers' 	=> array(
		'Justinhilles\Admin\Models\User' => '\Justinhilles\Admin\Observers\UserObserver'
	),
	'commands' 		=> array(
		'command.admin.install' => 'Justinhilles\Admin\Commands\AdminInstallCommand',
		'command.admin.user.create' => 'Justinhilles\Admin\Commands\UserCreateCommand',
		'command.admin.user.password' => 'Justinhilles\Admin\Commands\UserChangePasswordCommand',
		'command.admin.user.activate' => 'Justinhilles\Admin\Commands\UserActivateCommand'
	),
	'files'			=> array(
		__DIR__.'/../routes/routes.php',
		__DIR__.'/../filters.php',
		__DIR__.'/../macros.php',
		__DIR__.'/../global.php'
	),
	'components' => array(
		'admin' => 'Justinhilles\Admin\Admin'
	)
);