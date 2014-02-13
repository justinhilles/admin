<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        {{ HTML::style('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css') }}
        {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css') }}
        {{ HTML::style('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css') }}
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