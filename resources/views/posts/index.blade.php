@extends('layouts.master')

@section('content')
    <ul class="list-group">
        @foreach($posts as $post)
            <a href="{{$post->path()}}" class="list-group-item">{{$post->title}}</a>
        @endforeach
    </ul>
@endsection