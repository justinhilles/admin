{{ Form::tag('admin.roles', (isset($role) ? $role : null)) }}

    <div class="control-group">
        {{ Form::label('name', 'Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('name') }}
        </div>
    </div>

    <div class="control-group">
            {{ Form::label('permissions', 'Permissions:', array('class' => 'control-label')) }}
        <div class="controls">
            <?php $values = isset($role) ? $role->perms()->get()->lists('id') : array();?>
            {{ Form::checkboxes('permissions', $values, Permission::get()->lists('display_name','id')) }}
        </div>
    </div>

    {{ Form::buttons('admin.roles.index')}}

{{ Form::close() }}

@include('admin::global.errors', array('errors' => $errors))