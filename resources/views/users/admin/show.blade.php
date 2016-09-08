@extends('layouts.app')

@section('title','|View User')

@section('content')
    <div class="row">
        <div class="col-md-8">
          <hr>
          <div class="comment">
            <div class="author-info">
              <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email))) . "?d=mm"}}" class="profilePicture">
              <div>
                  <h1>{{$user->lastname}}&nbsp{{$user->firstname}}</h1>
              </div>
            </div>

            @foreach($user->roles as $role)
              <div class="comment-content">
                <span class="label label-default filter-cat">
                  <a style="color: inherit" href="{{route('roles.show',$role->id)}}">
                      {{$role->name}}</a> </span>
              </div>
            @endforeach

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
                        <h4 class="modal-title">Are you sure you want to remove this user?</h4>
                      </div>
                      <div class="modal-body">
                      <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                      {!! Form::open(array('route' => ['users.destroy',$user->id],'method'=>'DELETE')) !!}
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
                      {!! Html::linkRoute('users.edit','Edit User details',[$user->id],['class'=>'btn btn-primary btn-block','style' => 'padding: 10px 0px;']) !!}
                  </div>
                  <div class="col-md-12 app-button">
                      <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal">Delete User</button>
                  </div>
                    <hr>
                    <div class="col-md-12 app-button">
                        {!! Html::linkRoute('users.index','<<See All Userss',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
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
