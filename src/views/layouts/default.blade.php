<!DOCTYPE html>
<html>
    <head>
        <title>{{ Config::get('admin::config.title') }}</title>
        @stylesheets('admin')
    </head>
    <body>
        @if(Auth::user())
          <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                  @include('admin::global.nav')
                </div>
            </div>
          </div>
        @endif
        <div id="main" class="container">
            @include('admin::global.flash')
            @section('top')
              @include('admin::global.top', compact('links'))
            @show
            @yield('main')
       	</div>
        @javascripts('admin')
    </body>
</html>