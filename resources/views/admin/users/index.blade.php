@extends('layouts.admin')
@section('content')
        <div class="col">
            @if(Session::has('user_message'))
                <p class="alert alert-info" >{{session('user_message')}}</p>
            @endif
        </div>
    <div class="row">
        <h1 class="text-center">Users</h1>
        <table class="table table-striped">
            <thread>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Deleted</th>
                    <th>Actions</th>
                </tr>
            </thread>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        <img height="62" width="auto" src="{{$user->photo ? asset($user->photo->file) : 'https://via.placeholder.com/62'}}" alt="{{$user->name}}">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge badge-pill badge-info">{{$role->name}}</span>
                        @endforeach
                    </td>
                    <td>{{$user->is_active ? 'Not Active' : 'Active'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>{{$user->deleted_at}}</td>
                    <td>
                        @if($user->deleted_at != null)
                            <a class="btn btn-warning" href="{{route('users.restore',$user->id)}}"><i class="fa-solid fa-bandage"></i></a>
                        @else
                            {!! Form::open(['method'=>'DELETE', 'action'=>['App\Http\Controllers\AdminUsersController@destroy',$user->id]]) !!}
                            {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->render()}}
    </div>

@endsection
