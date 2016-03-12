@extends('snatertj.usersmanager.default')


@section('content')

    <h1>Update user</h1>
    <a href="{{ route('user.manager.index') }}" class="btn btn-danger">Back</a>
    <hr>    
    @include('snatertj.usersmanager.errors')
    {!! Form::model($user, ['route' => ['user.manager.update', $user->id], 'class' => 'form', 'method' => 'PUT']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('old_password', 'Current Password') !!}
            {!! Form::password('old_password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'New Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm new password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            <span class="check-password"></span>
        </div>
        <div class="form-group">
        @if (config('snatertj.usermanager.multiple'))
           @if($roles->count())
                {!! Form::label('role', 'Roles') !!}
                <br>
                @foreach($roles as $id => $role)
                    <?php $checked = '' ?>
                    @foreach($user->roles as $usedRole)
                        @if($id == $usedRole->id)
                            <?php $checked = 'checked' ?>
                        @endif
                    @endforeach
                    <label class="checkbox-inline">
                        <input type="checkbox" id="role{{$id}}" name="role[]" value="{{ $id }}" {{ $checked }}> {{ $role }}
                    </label>
                @endforeach
            @endif
        @else
            {!! Form::label('role', 'Role') !!}
            <select name="role" id="role" class="form-control">
                <option value="">---- Select a Role ----</option>
                @if($roles->count())
                <optgroup label="All the available roles">
                    @foreach($roles as $id => $role)
                        @if($user->roles()->count())
                            @if($id == $user->roles()->first()->id)
                                <option value="{{ $id }}" selected>{{ $role }}</option>
                            @else
                                <option value="{{ $id }}">{{ $role }}</option>
                            @endif
                        @else
                            <option value="{{ $id }}">{{ $role }}</option>
                        @endif
                    @endforeach
                </optgroup>
                @endif
            </select>
        @endif
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-success form-control']) !!}
        </div>
    {!! Form::close() !!}

@endsection

@section('script')

    <script src="{{ asset('/assets/js/user-manager.js') }}"></script>

@endsection