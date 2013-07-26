<?php

function has_access_to_link($link) {
	return (boolean) (isset($link['role']) AND  Sentry::check());
}