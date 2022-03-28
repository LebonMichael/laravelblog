@extends('layouts.admin')
@section('content')
    <div class="col-12">
        <h1>Post Comments</h1>
        <p>Display {{$comments->count()}} of {{$comments->total()}}</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>E-mail</th>
                <th>Body</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($comments)
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->user->email}}</td>
                        <td>{{$comment->body}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->updated_at}}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{route('comments.update', $comment->id)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_active" value="{{$comment->is_active}}">
                                    @if($comment->is_active)
                                        <button type="submit" href="" data-toggle="tooltip" data-placement="top"
                                                title="Post comment approved" class="btn btn-success mr-1"><i
                                                class="fas fa-unlock"></i></button>
                                    @else
                                        <button type="submit" href="" class="btn btn-danger mr-1">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    @endif
                                    <a href="{{route('home.post', $comment->post->slug)}}" class="btn btn-info mr-1"><i
                                            class="fas fa-eye">Post</i></a>
                                    <a href="" class="btn btn-success mr-1"><i class="fas fa-eye">Replies</i></a>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>




@endsection
