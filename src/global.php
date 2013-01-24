<?php

App::fatal(function($exception) {
    
});

App::missing(function($exception)
{
    return Response::view('admin::errors.missing', array(), 404);
});