@extends('gertjanroke.usersmanager.default')


@section('content')

    <h1>Create new role</h1>
    <p><a href="{{ route('role.manager.index') }}" class="btn btn-danger">Back</a></p>
    @include('gertjanroke.usersmanager.errors')
    {!! Form::open(['route' => 'role.manager.store', 'class' => 'form']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create', ['class' => 'btn btn-success form-control']) !!}
        </div>
    {!! Form::close() !!}

@endsection