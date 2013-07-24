<?php

Route::filter('auth', function() {
	if (!Sentry::getUser()) {
		Session::flash('redirect', Request::url() );
		return Redirect::guest(URL::route('admin.login'));
	}
});