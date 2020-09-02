@extends('layouts.app')

@section('title',"| Admissions")

@section('content')
    <div class="row">
        <div class="col-md-3" style="margin: 15px; background: lightgray">
            <div class="post">
                <h1>Apply for Enrollmenent </h1>
                <p> To apply for Enrollment, please pay the enrollment fee to a bank. Use the generated code to start and retrieve your
                application. to start click on the button below.</p>
                <a href="{{route('application.prospect')}}" class="btn btn-primary btn-lg btn-block">Start/Retrieve an Application</a>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <h1>Latest Admissions News</h1>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $post)
                    <div class="post">
                        <h2>{{$post->title}}</h2>
                        <h5>Published: {{date('M,j,Y h:ia',strtotime($post->created_at))}}</h5>
                        <p>{{substr(strip_tags($post->body),0,300)}} {{strlen(strip_tags($post->body)) > 300 ? "...":""}}</p>
                        <a href="{{route('news.single',$post->id)}}" class="btn btn-primary"> Read More...</a>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>

@stop
