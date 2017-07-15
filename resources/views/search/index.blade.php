@extends('layouts.master')

@section('content')

        <form method="GET" action="{{route('search')}}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" @keyup="suggest" v-model="query" name="q" placeholder="ابحث في المقالات...    ">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">بحث</button>
                    </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </form>

@endsection