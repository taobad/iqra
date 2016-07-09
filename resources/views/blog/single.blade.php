@extends('layouts.app')

@section('title',"| $post->title")

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{$post->title}}</h1>
            <p> {{$post->body}}</p>
            <hr>
            <p>@foreach($post->categories as $category)
                    <span class="label label-default"><a style="color: inherit" href="{{route('pub_categories.show',$category->id)}}">{{$category->name}}</a></span>
                @endforeach</p>
        </div>
    </div>
@stop