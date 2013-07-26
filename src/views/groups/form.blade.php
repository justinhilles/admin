{{ Form::tag('admin.groups', (isset($group) ? $group : null)) }}

    <div class="control-group">
        {{ Form::label('name', 'Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('name') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('name', 'Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::checkboxes('permissions', isset($group) ? array_keys($group->permissions) : array(), \Justinhilles\Admin\Models\Permission::all()->lists('name', 'slug')) }}
        </div>
    </div>

    {{ Form::buttons('admin.groups.index')}}

{{ Form::close() }}

@include('admin::global.errors')