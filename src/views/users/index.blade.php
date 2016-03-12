@extends('snatertj.usersmanager.default')


@section('content')

    <h1>All users</h1>
    <a class="btn btn-primary" href="{{ route('user.manager.create') }}">Create new user</a>
@if($users->count())
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->roles->count())
                        <?php $i = 0; $maxRoles = $user->roles->count() ?>
                        @foreach($user->roles as $role)
                            <?php $i++; ?>
                            {{ $role->name }}
                            @if($i < $maxRoles)
                                <span> / </span>
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm pull-left" href="{{ route('user.manager.edit', $user->id) }}">Edit</a>
                    {!! Form::open(['route' => ['user.manager.destroy', $user->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm pull-left']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@if($deletedUsers->count())
    <hr>
    <p class="deleted-users"><strong>Deleted users:</strong></p>
    <table class="table deleted-users">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deletedUsers as $deleted_user)
            <tr>
                <td>{{ $deleted_user->id }}</td>
                <td>{{ $deleted_user->name }}</td>
                <td>{{ $deleted_user->email }}</td>
                <td>
                    @foreach($deleted_user->roles as $role)
                        {{ $role->name }} 
                    @endforeach
                </td>
                <td>
                    {!! Form::open(['route' => ['user.manager.restore', $deleted_user->id]]) !!}
                        {!! Form::submit('Restore', ['class' => 'btn btn-warning btn-sm pull-left']) !!}
                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['user.manager.permanentlyDestroy', $deleted_user->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete permanently', ['class' => 'btn btn-danger btn-sm pull-left']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
@endif
@if(!$users->count() && !$deletedUsers->count())
    <p>No users found.</p>
@endif

@endsection