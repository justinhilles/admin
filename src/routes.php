<?php

Route::group(array('prefix' => 'admin', 'before' => ''), function() {

	//User Management
	Route::resource('users', 'Justinhilles\Admin\Controllers\UserAdminController');
	Route::resource('roles', 'Justinhilles\Admin\Controllers\RolesAdminController');
	Route::resource('permissions', 'PermissionsAdminController');

	//Dashboard
	Route::get('/', 'UserAdminController@dashboard');
});

Route::group(array('prefix' => 'admin'), function() {
	Route::get('confirm/{code}', 'UserAdminController@confirm');
	Route::get('forgot', 'UserAdminController@forgot_password');
	Route::post('forgot', 'UserAdminController@do_forgot_password');
	Route::get('reset_password/{token}', 'UserAdminController@reset_password');
	Route::post('reset_password', 'UserAdminController@do_reset_password');
	Route::get('login', 'UserAdminController@login');
	Route::post('login', 'UserAdminController@do_login');
	Route::get('logout', 'UserAdminController@logout');
});