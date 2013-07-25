@extends('admin::layouts.default')

@section('main')

<h1>All Groups</h1>

@if ($groups->count())
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
            @foreach ($groups as $group)
                <tr>
                    <td>{{{ $group->name }}}</td>
					<td>{{ $group->permissions }}</td>
                    <td>{{ link_to_route('admin.groups.edit', 'Edit', array($group->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.groups.destroy', $group->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no groups
@endif
    <p>{{ link_to_route('admin.groups.create', 'Add new Group', array(), array('class' => 'btn btn-success')) }}</p>
@stop