<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        @stylesheets(Config::get('admin::config.collections'))
        @section('stylesheets')
        @show
    </head>
    <body>
    	@yield('default')
    	@javascripts(Config::get('admin::config.collections'))
    	@section('javascripts')
    	@show
    </body>
</html>