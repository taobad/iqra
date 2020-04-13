@extends('layouts.app')

@section('title',"| Admissions")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Latest Admissions News
                <span class="pull-right">
                    <a href="{{route('application.prospect')}}" class="btn btn-primary btn-lg btn-block">Start/Retrieve an Application</a>
                </span>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($posts as $post)
                <div class="post">
                    <h2>{{$post->title}}</h2>
                    <h5>Published: {{date('M,j,Y h:ia',strtotime($post->created_at))}}</h5>
                    <p>{{substr(strip_tags($post->body),0,300)}} {{strlen(strip_tags($post->body)) > 300 ? "...":""}}</p>
                    <a href="{{route('news.single',$post->id)}}" class="btn btn-primary"> Read More...</a>
                </div>
                <hr>
            @endforeach
                <div class="text-center">
                    {!! $posts->links() !!}
                </div>
        </div>
    </div>

@stop
