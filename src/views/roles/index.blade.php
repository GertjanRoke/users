@extends('snatertj.usersmanager.default')


@section('content')

    <h1>All roles</h1>
    @if($roles->count())
        <a class="btn btn-primary" href="{{ route('role.manager.create') }}">Create new role</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('role.manager.edit', $role->id) }}">Edit</a>
                        {!! Form::open(['route' => ['role.manager.destroy', $role->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No roles found.</p>
        <a class="btn btn-primary" href="{{ route('role.manager.create') }}">Create new role</a>
    @endif

@endsection