<?php

function has_access_to_link($link) {
	return (boolean) 	(isset($link['role']) AND 
						Auth::user() AND 
						Auth::user()->hasRole($link['role'])) OR 
						!isset($link['role']) OR 
						(Auth::user() AND Auth::user()->roles()->count() == 0);
}