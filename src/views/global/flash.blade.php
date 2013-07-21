<div id="flash">
	@if ( Session::get('notice') )
	    <div class="flash alert">{{{ Session::get('notice') }}}</div>
	@endif
	@if (Session::has('success'))
	    <div class="flash alert alert-success">{{ Session::get('success') }}</div>
	@endif
	@if (Session::has('message'))
	    <div class="flash alert alert-info">{{ Session::get('message') }}</div>
	@endif
	@if ( Session::has('error') )
	    <div class="flash alert alert-error">{{{ Session::get('error') }}}</div>
	@endif
</div>