<?php


Route::filter('auth', function() {
	if (Auth::guest()) {
		Session::flash('redirect', Request::url() );
		return Redirect::guest(URL::route('admin.login'));
	}
});