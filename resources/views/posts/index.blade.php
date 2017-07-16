@extends('layouts.master')

@section('content')
    <posts :posts="{{$posts->toJson()}}"></posts>
@endsection