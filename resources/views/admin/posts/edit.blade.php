@extends('layouts.admin')
@section('content')
    <div class="col-12">
        <h1>Edit Post</h1>
        @include('includes.form_error')
        <div class="row">
            <div class="col-6">
                <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input value="{{$post->title}}" type="text" name="title" id="title" class="form-control"
                               placeholder="Title...">
                    </div>
                    <div class="form-group">
                        <label for="category">Category (CTRL + CLICK multiple select)</label>
                        <select name="categories[]" class="form-control custom-select" multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        @if($post->categories->contains($category->id)) selected
                                    @endif>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <textarea class="form-control" name="body" id="body" cols="100%" rows="10" placeholder="Description...">
                        {{$post->body}}
                    </textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="photo_id" id="ChooseFile">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
            <div class="col-6">
                <label for="">Featured Image</label>
                <img class="img-fluid img-thumbnail"
                     src="{{$post->photo ? asset($post->photo->file) : 'http://via.placeholder.com/400'}}" alt="">
            </div>
        </div>
    </div>

@endsection
