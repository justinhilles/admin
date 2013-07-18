@if (Session::has('message'))
    <div class="flash alert">
        <p>{{ Session::get('message') }}</p>
    </div>
@endif
@if ( Session::get('notice') )
    <div class="flash alert">{{{ Session::get('notice') }}}</div>
@endif