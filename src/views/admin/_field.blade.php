<div class="control-group">
    {{ Form::label($name, (isset($field['label']) ? $field['label'] : ucfirst($name)), array('class' => 'control-label')) }}
    <div class="controls">
    	@if(isset($field['raw']))
    		{{ $field['raw'] }}
    	@else
        	{{ Form::$field['type']($name, (isset($field['value']) ? $field['value']: null), (isset($field['attributes']) ? $field['attributes']: array()) ) }}
        @endif
    </div>
</div>