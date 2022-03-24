@extends('layouts.admin')
@section('content')
    <div class="col-12">
        @include('includes.form_error')
        <div class="card mb-3" style="width:540px;">
            <div class="row no-gutters">
                <div class="col-md-4 align-items-stretch">
                    <img class="img-fluid" src="{{$post->photo ? asset($post->photo->file): 'http://via.placeholder.com/400x400'}}"
                         alt="{{$post->title}}">
                    <div>
                        @if($post->categories)
                            @foreach($post->categories as $category)
                                <span class="badge badge-pill badge-info">{{$category->name}}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->user->name}}</p>
                        <p class="card-text"><small class="text-muted">{{$post->updated_at->diffForhumans()}}</small></p>
                        <p class="card-text">{{$post->body}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
