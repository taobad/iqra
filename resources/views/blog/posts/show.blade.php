@extends('layouts.app')

@section('title','|View Post')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{$post->title}}</h1>
            <p class="lead">{{$post->body}}</p>
            <div class="row">
                <div class="row col-sm-5 col-sm-offset-1">
                    {!! Html::linkRoute('posts.edit','Edit',[$post->id],['class'=>'btn btn-primary btn-block']) !!}
                </div>
                <div class="row col-sm-5 col-sm-offset-1">
                    {!! Form::open(array('route' => ['posts.destroy',$post->id],'method'=>'DELETE')) !!}
                    {{Form::submit('Delete',['class'=>  "btn btn-danger btn-block" ])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-offset-1">
            <div class="well">
                <div class="row">
                    <hr>
                    <div class="col-md-12">
                        {!! Html::linkRoute('posts.index','<<See All Posts',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection