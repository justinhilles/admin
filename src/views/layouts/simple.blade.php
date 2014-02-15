<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        @section('stylesheets')
            {{ HTML::style('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css') }}
            {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css') }}
            {{ HTML::style('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css') }}
            {{ stylesheet_link_tag('justinhilles/admin/assets/stylesheets/package') }}
        @show
    </head>
    <body>
        @yield('default')
        @section('javascripts')
            {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js')}}
            {{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js') }}
            {{ HTML::script('//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js') }}
            {{ javascript_include_tag('justinhilles/admin/assets/javascripts/package') }}
        @show
    </body>
</html>