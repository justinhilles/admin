<?php

return array(
	'prefix' => 'admin',
	'title' => 'Admin',
	
	'aliases' => array(
		'User' 		=> 'Justinhilles\Admin\Models\User',
		'Role' 		=> 'Justinhilles\Admin\Models\Role',
		'Permission'=> 'Justinhilles\Admin\Models\Permission',
		'Confide' 	=> 'Zizaco\Confide\ConfideFacade',
		'UserAdminController' => 'Justinhilles\Admin\Controllers\Admin\UserAdminController',
		'AdminController' => 'Justinhilles\Admin\Controllers\Admin\AdminController',
		'UserController' => 'Justinhilles\Admin\Controllers\UserController'
	),
	'providers' => array(
		'Zizaco\Confide\ConfideServiceProvider',
		'Zizaco\Entrust\EntrustServiceProvider',
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