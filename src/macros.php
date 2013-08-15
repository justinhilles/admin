<?php

\Form::macro('delete', function($route, $options = array()){
	$html   = array();
    $html[] = \Form::open(array('method' => 'DELETE', 'route' => $route));
    $html[] = \Form::submit('Delete', array('class' => 'btn btn-danger'));
    $html[] = \Form::close();
	return 	(string) implode("\n", $html);
});