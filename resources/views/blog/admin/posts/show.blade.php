@extends('layouts.app')

@section('title','|View Post')

@section('content')
    <div class="row">
        <div class="col-md-8">
          <div class="row">
              @if($post->images()->count() > 0)
                  @include('layouts.partials._posts_image_slider')
              @endif
          </div>
          <h1>{{$post->title}}</h1>
          <p class="lead">{!!$post->body!!}</p>
          <hr>

          <div id="backend-comments" style="margin-top: 50px;">
                <h3>Comments <small> {{ $post->comments()->count() }} total </small></h3>
                <?php $counts = $post->comments()->count() ?>
                @if($counts > 0)
                <table class="table">
                  <thead>
                    <tr>
                      <th> Name </th>
                      <th> Email </th>
                      <th> Comment </th>
                      <th width ="60px"></th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($post->comments as $comment)
                      <tr>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->user->email }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                          <a href="{{route('comments.edit',$comment->id)}}" class='btn btn-xs btn-primary'><span class="glyphicon glyphicon-pencil"></span></a>
                          <a href="{{route('comments.delete',$comment->id)}}" class='btn btn-xs btn-danger'><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
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
                        <h4 class="modal-title">Are you sure you want to delete the post?</h4>
                      </div>
                      <div class="modal-body">
                      <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                      {!! Form::open(array('route' => ['posts.destroy',$post->id],'method'=>'DELETE')) !!}
                      </div>
                      <div class="modal-footer">
                          {{Form::submit('Delete',['class'=>  "btn btn-danger app-button" ])}}
                          {{Form::button('Close',['class' => 'btn btn-primary app-button','data-dismiss' => 'modal'])}}
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>

        <div class="col-md-3 col-sm-offset-1">
            <div class="well">
                <div class="row">
                  <div class="col-md-12 app-button">
                      {!! Html::linkRoute('posts.edit','Edit Post',[$post->id],['class'=>'btn btn-primary btn-block','style' => 'padding: 10px 0px;']) !!}
                  </div>
                  <div class="col-md-12 app-button">
                      <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal">Delete Post</button>
                  </div>
                    <hr>
                    <div class="col-md-12 app-button">
                        {!! Html::linkRoute('posts.index','<<See All Posts',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/jssor.slider.mini.js') !!}
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
                $FillMode: 1,
                $AutoPlay: true,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $Cols: 9,
                    $SpacingX: 3,
                    $SpacingY: 3,
                    $Align: 260
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 600);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
@endsection
