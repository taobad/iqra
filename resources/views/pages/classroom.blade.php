@extends('layouts.app')

@section('title',"| Virtual Classroom")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Virtual Classroom</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4></h4></div>
                    <div class="panel-body videoWrapper">
                        <iframe width="420" height="315"
                                src="https://www.youtube.com/embed/qf6Ch3hUfQY">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-1">
            @foreach($posts as $post)
                <div class="post">
                    <h2>{{$post->title}}</h2>
                    <h5>Published: {{date('M,j,Y h:ia',strtotime($post->created_at))}}</h5>
                    <p>{{substr(strip_tags($post->body),0,300)}} {{strlen(strip_tags($post->body)) > 300 ? "...":""}}</p>
                    <a href="{{route('news.single',$post->id)}}" class="btn btn-primary"> Read more</a>
                </div>
                <hr>
            @endforeach
                <div class="text-center">
                    {!! $posts->links() !!}
                </div>
        </div>
    </div>

@stop
