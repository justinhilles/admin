@extends('admin::layouts.simple')

@section('default')
  @if(Sentry::getUser())
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class="container">
            @include('admin::global.nav')
          </div>
      </div>
    </div>
  @endif
  <div id="main" class="container">
      @section('top')
        @include('admin::global.top', compact('links'))
      @show
      @include('admin::global.flash')
      @yield('main')
 	</div>
@stop