<?php

Route::group(array('prefix' => Config::get('admin::config.prefix', 'admin'), 'before' => 'auth|permission'), function() {

	//User Management
	Route::resource('users', 'Justinhilles\Admin\Controllers\Admin\UserAdminController');
	Route::resource('groups', 'Justinhilles\Admin\Controllers\Admin\GroupsAdminController');
	Route::resource('permissions', 'Justinhilles\Admin\Controllers\Admin\PermissionsAdminController');

	//Edit Profile
	Route::get('profile', array('as' => 'admin.profile', 'uses' => 'Justinhilles\Admin\Controllers\Admin\UserAdminController@profile'));
	
	//Dashboard
	Route::get('/', array('as' => 'admin.dashboard' , 'uses' => 'Justinhilles\Admin\Controllers\Admin\UserAdminController@dashboard'));
	
});

Route::group(array('prefix' => Config::get('admin::config.prefix', 'admin')), function() {
	
	//forgot
	Route::get('forgot',  array('as' => 'admin.forgot', 'uses' => 'Justinhilles\Admin\Controllers\UserController@forgot'));
	Route::post('forgot', array('as' => 'admin.do_forgot', 'uses' => 'Justinhilles\Admin\Controllers\UserController@do_forgot'));
	
	//reset
	Route::get('reset_password/{code}', array('as' => 'admin.reset', 'uses' => 'Justinhilles\Admin\Controllers\UserController@reset'));
	Route::post('reset_password/{code}', array('as' => 'admin.do_reset', 'uses' => 'Justinhilles\Admin\Controllers\UserController@do_reset'));
	
	//code
	Route::get('confirm/{code}', array('as' => 'admin.code', 'uses' => 'AuthController@confirm'));

	//login
	Route::get('login',  array('as' => 'admin.login', 'uses' => 'AuthController@login'));
	Route::post('login', array('as' => 'admin.do_login', 'uses' => 'AuthController@do_login'));

	//logout
	Route::get('logout', array('as' => 'admin.logout', 'uses' => 'AuthController@logout'));

});