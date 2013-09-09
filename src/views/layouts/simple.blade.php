<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        @stylesheets(Config::get('admin::config.collections'))
        @section('stylesheets')
        @show
        <!-- Queue $ calls till jQuery loaded at bottom -->
        <script type='text/javascript'>window.q=[];window.$=function(f){q.push(f)}</script>
    </head>
    <body>
    	@yield('default')
    	@javascripts(Config::get('admin::config.collections'))
    	@section('javascripts')
    	@show
    </body>
</html>