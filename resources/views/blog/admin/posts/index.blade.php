@extends('layouts.app')

@section('title','|All Posts')

@section('content')
    @include('layouts.partials._sort-category')
    <div class="row">
        <div class="col-md-5">
            <h1>All posts</h1>
        </div>

        <div class="col-md-2 app-button">
              <a href="{{route('posts.create')}}" class="btn btn-primary btn-lg btn-block"> Add </a>
        </div>
        <div class="col-md-2 app-button">
             <p><button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Search</button>
        </div>
        <div class="col-md-2 app-button">
            <a href="{{route('posts.index')}}" class="btn btn-primary btn-lg btn-block"> Clear Search </a>
        </div>

        <div class="col-md-12">
            <hr>
                  <!-- Modal -->
            <div id="myModal" class="modal fade col-md-6 col-md-offset-3" role="dialog">
              <div class="modal-dialog">

               <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Search Posts By Title</h4>
                  </div>
                  <div class="modal-body">
                  <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                    {!! Form::open(array('route' => 'posts.search')) !!}
                      {{Form::text('title',null,['class'=>'form-control'])}}
                  </div>
                  <div class="modal-footer">
                      {{Form::submit('Search',['class' => 'btn btn-primary', 'required'=> 'required'])}}
                      {{Form::button('Close',['class' => 'btn btn-danger','data-dismiss' => 'modal'])}}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                @if($posts)
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th>{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{substr(strip_tags($post->body),0,50)}} {{strlen(strip_tags($post->body)) > 50 ? "...":""}}</td>
                            <td>{{date('M,j,Y',strtotime($post->created_at))}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('posts.show',$post->id)}}">View</a> <a class="btn btn-primary btn-sm" href="{{route('posts.edit',$post->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

            <div class="text-center">
                {!! $posts->render() !!}
            </div>
        </div>
    </div>
@stop
