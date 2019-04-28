@extends('layouts.app')

@section('title',"| $post->title")

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="col-md-12">
            <div id="gallery-images">
                <ul>
                    @foreach($post->images as $image)
                      <li>
                          <a href="{{URL::to('/img')}}/posts/{{$post->id}}/{{$image->name}}" data-lightbox="postimages">
                            {!! Html::image("img/posts/$post->id/thumbnail$image->name", 'image',['data-u' => 'thumb']) !!}
                          </a>
                      </li>
                    @endforeach
                </ul>
            </div>
          </div>

          <div class="col-md-12">
            <h1>{{$post->title}}</h1>
            <p class="lead">{!!$post->body!!}</p>
            <hr>
            <p>@foreach($post->categories as $category)
                <span class="label label-default"><a style="color: inherit" href="{{route('pub_categories.show',$category->id)}}">{{$category->name}}</a></span>
              @endforeach
            </p>
          </div>

        </div>

        <div class="col-md-12 ">
          <div class="col-md-2">
            <hr>
            <button type="button" class="col-md-2 btn btn-info btn-block" data-toggle="modal" data-target="#myModal"> Add Comment </button>
          </div>
        </div>

        <div id="myModal" class="modal fade col-md-6 col-md-offset-3" role="dialog">
          <div class="modal-dialog">
              <div class = "modal-content">
                <div class="modal-header">
                  <h3> Post New Comment </h3>
                </div>

                <div class="modal-body">
                  {!! Form::open (['route' => ['comments.store',$post->id], 'method' => 'POST']) !!}

                      <div class="form-group">
                          <label name="comment">Comment:</label>
                          <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Type your comment here"></textarea>
                      </div>

                      <input type="submit" class="btn btn-success" value="submit">
                  {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <h3 class="comments-title"> <span class="glyphicon glyphicon-comment"></span>{{ $post-> comments()-> count()}} Comments</h3>
            @foreach($post->comments as $comment)
              <hr>
              <div class="comment">
                <div class="author-info">
                  <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->user->email))) . "?s=50&d=mm"}}" class="author-image">
                  <div class="author-name">
                      <h4> {{$comment->user->name}} </h4>
                      <p class="author-time"> {{date('F nS, Y - g:iA',strtotime($comment->created_at))}} </p>
                  </div>
                </div>
                <div class="comment-content">
                  {{$comment->comment}}
                </div>
              </div>
            @endforeach
          </div>
        </div>

    </div>
@stop

@section('scripts')
    {!! Html::script('js/lightbox.min.js') !!}
@endsection
