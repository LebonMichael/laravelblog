@extends('layouts.admin')
@section('content')
    <h1>Photos</h1>
    <table class="table table-striped">
        <thread>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>File</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thread>
        <tbody>
        @foreach($photos as $photo)
            <tr>
                <td>{{$photo->id}}</td>
                <td>
                    <img height="62" width="auto" src="{{$photo->file ? asset($photo->file) : 'https://via.placeholder.com/62'}}" alt="{{$photo->file}}">
                </td>
                <td>{{$photo->file}}</td>
                <td>{{$photo->created_at->diffForHumans()}}</td>
                <td>{{$photo->updated_at->diffForHumans()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
