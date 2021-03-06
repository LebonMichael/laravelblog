@extends('layouts.admin')
@section('content')
    <div class="col-12 text-center">
        <h1>Create User</h1>
        <div class="col-6 offset-4 mx-auto">
            @include('includes.form_error')
            {!! Form::open(['method' => 'post', 'action' => 'App\Http\Controllers\AdminUsersController@store' , 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('name',' Name:') !!}
                {!! Form::text('name', null, ['class' =>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email',' E-mail:') !!}
                {!! Form::text('email', null, ['class' =>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Select roles: (CTRL + Click multiple') !!}
                {!! Form::select('roles[]', $roles,null,['class' =>'form-control','multiple'=>'multiple']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active','Status:') !!}
                {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'),0,['class' =>'form-control']) !!}
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
                {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
