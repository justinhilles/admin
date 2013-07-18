@extends('admin::layouts.default')

@section('main')

<h1>All Roles</h1>

@if ($roles->count())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
				<th>Permissions</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{{ $role->name }}}</td>
					<td>{{ $role->getDisplayPermissions() }}</td>
                    <td>{{ link_to_route('admin.roles.edit', 'Edit', array($role->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.roles.destroy', $role->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no roles
@endif
    <p>{{ link_to_route('admin.roles.create', 'Add new Role', array(), array('class' => 'btn btn-success')) }}</p>
@stop