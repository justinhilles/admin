<?php

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {

	//User Management
	Route::resource('users', 'Justinhilles\Admin\Controllers\Admin\UserAdminController');
	Route::resource('roles', 'Justinhilles\Admin\Controllers\Admin\RolesAdminController');
	Route::resource('permissions', 'Justinhilles\Admin\Controllers\Admin\PermissionsAdminController');

	//Dashboard
	Route::get('/', array('as' => 'admin.dashboard' , 'uses' => 'UserAdminController@dashboard'));
});

Route::group(array('prefix' => 'admin'), function() {
	
	//forgot
	Route::get('forgot',  array('as' => 'admin.forgot', 'uses' => 'UserController@forgot'));
	Route::post('forgot', array('as' => 'admin.do_forgot', 'uses' => 'UserController@do_forgot'));
	
	//reset
	Route::get('reset_password/{token}', array('as' => 'admin.reset', 'uses' => 'UserController@reset_password'));
	Route::post('reset_password', array('as' => 'admin.do_reset', 'uses' => 'UserController@do_reset_password'));
	
	//login
	Route::get('login',  array('as' => 'admin.login', 'uses' => 'UserController@login'));
	Route::post('login', array('as' => 'admin.do_login', 'uses' => 'UserController@do_login'));

	//logout
	Route::get('logout', array('as' => 'admin.logout', 'uses' => 'UserController@logout'));

	//code
	Route::get('confirm/{code}', array('as' => 'admin.code', 'uses' => 'UserController@confirm'));
});