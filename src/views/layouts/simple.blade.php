<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        @stylesheets(Config::get('admin::config.collection'))
    </head>
    <body>
    	@yield('default')
    	@javascripts(Config::get('admin::config.collection'))
    </body>
</html>