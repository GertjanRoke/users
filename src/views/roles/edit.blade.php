@extends('gertjanroke.usermanager.default')


@section('content')

    <h1>Create new role</h1>
    <p><a href="{{ route('role.manager.index') }}" class="btn btn-danger">Back</a></p>
    @include('gertjanroke.usermanager.errors')
    {!! Form::model($role, ['route' => ['role.manager.update', $role->id], 'method' => 'PUT', 'class' => 'form']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-success form-control']) !!}
        </div>
    {!! Form::close() !!}

@endsection
