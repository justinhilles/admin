@extends('admin::layouts.default')

@section('main')
    <h1>All Users</h1>
    @if ($users->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
    				<th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                    	<td>{{ $user->isActivated() ? '<i class="icon-ok btn-success btn"></i>':'<i class="icon-remove btn-danger btn"></i>'  }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ link_to_route('admin.users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
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