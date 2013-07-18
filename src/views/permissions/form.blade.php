{{ Form::tag('admin.permissions', (isset($permission) ? $permission : null)) }}

    <div class="control-group">
        {{ Form::label('name', 'Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('name') }}
        </div>
    </div>
    
    <div class="control-group">      
         {{ Form::label('display_name', 'Display_name:', array('class' => 'control-label')) }}
         <div class="controls">
            {{ Form::text('display_name') }}
        </div>
    </div>

    {{ Form::buttons('admin.permissions.index')}}

{{ Form::close() }}

@include('admin::global.errors', array('errors' => $errors))