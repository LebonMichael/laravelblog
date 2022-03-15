@extends('layouts.admin')
@section('content')
    <div class="col-12">
        <h1>Update User</h1>
        <div class="row">
            <div class="col-8">
                @include('includes.form_error')
                {!! Form::open(['method' => 'patch', 'action' => ['App\Http\Controllers\AdminUsersController@update',$user->id] , 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name',' Name:') !!}
                    {!! Form::text('name', $user->name, ['class' =>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email',' E-mail:') !!}
                    {!! Form::text('email', $user->email, ['class' =>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Select roles: (CTRL + Click multiple') !!}
                    {!! Form::select('roles[]', $roles,$user->roles->pluck('id')->toArray(),['class' =>'form-control','multiple'=>'multiple']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('is_active','Status:') !!}
                    {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'),$user->is_active,['class' =>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password',' Password:') !!}
                    {!! Form::password('password',['class' =>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id',' Photo:') !!}
                    {!! Form::file('photo_id',null,['class' =>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update User', ['class' => 'btn btn-primary']) !!}
                </div>
                    {!! Form::close() !!}
                    {!! Form::open(['method'=>'DELETE', 'action'=>['App\Http\Controllers\AdminUsersController@destroy',$user->id]]) !!}
                         {!! Form::submit('Delete User', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

            </div>
            <div class="col-4">
                <img class="img-fluid img-thumbnail"
                     src="{{$user->photo ? asset($user->photo->file) : 'https://via.placeholder.com/500'}}"
                     alt="{{$user->name}}">
            </div>
        </div>

    </div>
@endsection
