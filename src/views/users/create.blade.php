@extends('gertjanroke.usermanager.default')


@section('content')
    <h1>Create User</h1>
    <a href="{{ route('user.manager.index') }}" class="btn btn-danger">Back</a>
    <hr>
    @include('gertjanroke.usermanager.errors')
    {!! Form::open(['route' => 'user.manager.store', 'class' => 'form']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            <span class="check-password"></span>
        </div>
        <div class="form-group">
        @if (config('gertjanroke.usermanager.multiple'))
           @if($roles->count())
                {!! Form::label('role', 'Roles') !!}
                <br>
                @foreach($roles as $id => $role)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="role{{$id}}" name="role[]" value="{{ $id }}"> {{ $role }}
                    </label>
                @endforeach
            @endif
        @else
            {!! Form::label('role', 'Role') !!}
            <select name="role" id="role" class="form-control">
                <option value="">---- Select a Role ----</option>
                <optgroup label="All the available roles">
                @if($roles->count())
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}">{{ $role }}</option>
                    @endforeach
                @endif
                </optgroup>
            </select>
        @endif
        </div>
        <div class="form-group">
            {!! Form::submit('Create', ['class' => 'btn btn-success form-control']) !!}
        </div>
    {!! Form::close() !!}

@endsection

@section('script')

    <script src="{{ asset('/assets/js/user-manager.js') }}"></script>

@endsection
