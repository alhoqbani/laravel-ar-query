@extends('layouts.master')

@section('content')
    <div class="list-group" :posts="{{$posts->toJson()}}">
        <posts :posts="{{$posts->toJson()}}"></posts>
    </div>
@endsection