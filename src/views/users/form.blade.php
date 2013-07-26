{{ Form::tag('admin.users', (isset($user) ? $user : null)) }}

    <div class="control-group">
        {{ Form::label('first_name', 'First Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('first_name') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('last_name', 'Last Name:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::text('last_name') }}
        </div>
    </div>

	<div class="control-group">
        {{ Form::label('email', 'Email:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::text('email') }}
        </div>
    </div>

	<div class="control-group">
        {{ Form::label('password', 'Password:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::password('password') }}
        </div>
    </div>

	<div class="control-group">
        {{ Form::label('password_confirmation', 'Confirm Password:', array('class' => 'control-label')) }}
        <div class="controls">
        	{{ Form::password('password_confirmation') }}
        </div>
    </div>

    <div class="control-group">
        {{ Form::label('activated', 'Active?:', array('class' => 'control-label')) }}
        <div class="controls">
            {{ Form::checkbox('activated') }}
        </div>
    </div>

    <?php if(isset($user) AND $groups = $user->getGroups()->lists('id')):?>
        <div class="control-group">
            {{ Form::label('name', 'Name:', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::checkboxes('groups', $groups, \Justinhilles\Admin\Models\Group::all()->lists('name', 'id')) }}
            </div>
        </div>
    <?php endif;?>

    {{ Form::buttons('admin.users.index')}}

{{ Form::close() }}

@include('admin::global.errors', array('errors' => $errors))