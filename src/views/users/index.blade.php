@extends('admin::layouts.default')

@section('main')
    <h1>All Users</h1>
    @if ($users->count())
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Active</th>
    				<th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Groups</th>
                    <th>Permissions</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                    	<td>{{ $user->isActivated() ? '<i class="icon-ok btn-success btn"></i>':'<i class="icon-remove btn-danger btn"></i>'  }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->getDisplayGroups() }}</td>
                        <td>{{ $user->getDisplayPermissions(); }}</td>
                        <td>{{ link_to_route('admin.users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                        <td>{{ Form::delete(array('admin.users.destroy', $user->id)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links()}}
    @else
        There are no users
    @endif
    <p>{{ link_to_route('admin.users.create', 'Add new user', array(), array('class' => 'btn btn-success')) }}</p>
@stop