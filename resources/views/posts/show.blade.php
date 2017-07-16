@extends('layouts.master')

@section('content')
    <article class="post">
        <div class="post_title">
            <h2><a href="{{$post->path()}}" class="">{{$post->title}}</a></h2>
            <p class="lead">{{$post->short_title}}</p>
        </div>
        <div class="post_meta">
            <span>{{$post->author->name}} -</span>
            <span>{{$post->author->city->name}} -</span>
            <span>{{$post->date_time_string}}</span>
            <span class="pull-left"><a href="{{$post->link}}">المصدر</a></span>
        </div>
        <p class="post_text">{!! nl2br(e($post->text)) !!}</p>
    </article>
@endsection