@extends('layouts.app')

@section('title','|View Post')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{$post->title}}</h1>
            <p class="lead">{{$post->body}}</p>
            <div class="row">
                @if($post->images()->count() > 0)
                    @include('layouts.partials._posts_image_slider')
                @endif
            </div>
            <hr>
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