<?php

\Route::filter('auth', function() {
	if (!\Sentry::getUser()) {
		\Session::flash('redirect', \Request::url() );
		return \Redirect::guest(\URL::route('admin.login'));
	}
});

\Route::filter('permission', function($route, $request) {
	if(!\User::hasPermissionToRoute(Route::currentRouteName())) {
		return Redirect::route('admin.dashboard')->with('error', 'You are not authorized');
	}
});