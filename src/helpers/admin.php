<?php

function has_access_to_link($link) {
	$user = Sentry::getUser();

	if($user->isSuperUser()){
		return true;
	}

	//If the link has a set permission, check that against User
	if(isset($link['permission'])) {
		return (boolean) $user->hasAccess($link['permission']);

	//if link has a route, check that against route permissions
	} elseif(isset($link['route'])) {
		return (boolean) \User::hasPermissionToRoute($link['route']);
	}
}