<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        {{{ stylesheet_link_tag('assets/stylesheets/package') }}}
        @show
        <!-- Queue $ calls till jQuery loaded at bottom -->
        <script type='text/javascript'>window.q=[];window.$=function(f){q.push(f)}</script>
    </head>
    <body>
    	@yield('default')
    	{{{ javascript_include_tag('assets/javascripts/package') }}}
    	@section('javascripts')
    	@show
    </body>
</html>