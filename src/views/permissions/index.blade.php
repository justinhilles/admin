@extends('admin::layouts.default')

@section('main')

    <h1>All Permissions</h1>

    @if ($permissions->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{{ $permission->name }}}</td>
                        <td>{{{ $permission->slug }}}</td>
                        <td>{{ link_to_route('admin.permissions.edit', 'Edit', array($permission->id), array('class' => 'btn btn-info')) }}</td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.permissions.destroy', $permission->id))) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        There are no permissions
    @endif
     <p>{{ link_to_route('admin.permissions.create', 'Add new Permission', array(), array('class' => 'btn btn-success')) }}</p>
@stop