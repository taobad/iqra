@extends('layouts.app')
@section('title','| Home')
@section('content')
    <style media="screen" type="text/css">
        .videoWrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            padding-top: 25px;
            height: 0;
        }
        .videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .jumbotron {
            background-size: cover;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="item <?php echo ($i == 1) ? 'active' : '' ?>">
                                {!! Html::image("img/home_slider/iq_$i.jpeg", "iqra_img$i") !!}
                            </div>
                        @endfor
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4>LATEST NEWS</h4></div>

                            <div class="panel-body">
                                @foreach($newss as $news)
                                    <div class="post" id="homepage-news">
                                        <hr>
                                        <h4>{{$news->title}}</h4>
                                        <p>{{substr(strip_tags($news->body),0,300)}} {{strlen(strip_tags($news->body)) > 300 ? "...":""}}</p>
                                        <a href="{{route('news.single',$news->id)}}" class="btn btn-primary"> Read
                                            more</a>
                                        <hr>
                                    </div>

                                @endforeach
                                <hr>
                                <div class="col-md-8 col-md-offset-2">
                                    {!! Html::linkRoute('news.index','See More >>',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4></h4></div>
                        <div class="panel-body videoWrapper">
                            <iframe width="420" height="315"
                                    src="{{ $home_vid_path }}">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>Events</h4></div>
                        <div class="panel-body">
                            @foreach($events as $event)
                                <div class="list-group">
                                    <a href="{{route('news.single',$event->id)}}" class="list-group-item">
                                        <h4 class="list-group-item-heading text-not-overflow">
                                            {{$event->title}}
                                        </h4>

                                        <p class="list-group-item-text text-not-overflow">{{substr(strip_tags($event->body),0,70)}} {{strlen(strip_tags($event->body)) > 70 ? "...":""}}</p>

                                        <span class="<?php echo (strtotime($event->eventdate) < time()) ? 'icon-past-date' : 'icon-future-date';  ?>">
                                          <i class="glyphicon glyphicon-calendar"></i>
                                            {{$event->eventdate}}
                                        </span>
                                    </a>
                                </div>
                            @endforeach

                            <div class="col-md-8 col-md-offset-2">
                                {!! Html::linkRoute('news.events','See More >>',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>Awards</h4></div>
                        <div class="panel-body">
                            @foreach($awards as $award)
                                <div class="list-group">
                                    <a href="{{route('news.single',$award->id)}}" class="list-group-item">
                                        <h4 class="list-group-item-heading text-not-overflow">
                                            {{$award->title}}
                                        </h4>

                                        <p class="list-group-item-text text-not-overflow">{{substr(strip_tags($award->body),0,70)}} {{strlen(strip_tags($award->body)) > 70 ? "...":""}}</p>
                                    </a>
                                </div>
                            @endforeach
                            <div class="col-md-8 col-md-offset-2">
                                {!! Html::linkRoute('news.awards','See More >>',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        ( document ).ready(function() {
            var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

            if (isMobile) {
                //Conditional script here
            }
        });
    </script>
@endsection
