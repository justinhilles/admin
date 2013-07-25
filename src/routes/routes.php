<?php

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function() {

	//User Management
	Route::resource('users', 'Justinhilles\Admin\Controllers\Admin\UserAdminController');
	Route::resource('groups', 'Justinhilles\Admin\Controllers\Admin\GroupsAdminController');
	Route::resource('permissions', 'Justinhilles\Admin\Controllers\Admin\PermissionsAdminController');
	//Dashboard
	Route::get('/', array('as' => 'admin.dashboard' , 'uses' => 'Justinhilles\Admin\Controllers\Admin\UserAdminController@dashboard'));
});

Route::group(array('prefix' => 'admin'), function() {
	
	//forgot
	Route::get('forgot',  array('as' => 'admin.forgot', 'uses' => 'AuthController@forgot'));
	Route::post('forgot', array('as' => 'admin.do_forgot', 'uses' => 'AuthController@do_forgot'));
	
	//reset
	Route::get('reset_password/{token}', array('as' => 'admin.reset', 'uses' => 'AuthController@reset_password'));
	Route::post('reset_password', array('as' => 'admin.do_reset', 'uses' => 'AuthController@do_reset_password'));
	
	//login
	Route::get('login',  array('as' => 'admin.login', 'uses' => 'AuthController@login'));
	Route::post('login', array('as' => 'admin.do_login', 'uses' => 'AuthController@do_login'));

	//logout
	Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AuthController@logout'));

	//code
	Route::get('confirm/{code}', array('as' => 'admin.code', 'uses' => 'AuthController@confirm'));
});