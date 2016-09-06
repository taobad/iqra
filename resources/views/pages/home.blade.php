@extends('layouts.app')
@section('title','| Home')
@section('content')
    <div class="container">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active" >
                    {!! Html::image('img/home_slider/iq_1.jpeg', 'iqra_img1') !!}
                </div>

                <div class="item">
                    {!! Html::image('img/home_slider/iq_2.jpeg', 'iqra_img2') !!}
                </div>

                <div class="item">
                    {!! Html::image('img/home_slider/iq_3.jpeg', 'iqra_img3') !!}
                </div>

                <div class="item">
                    {!! Html::image('img/home_slider/iq_4.jpeg', 'iqra_img4') !!}
                </div>
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
            <div class="col-md-8">
              <div class="panel panel-default">
                  <div class="panel-heading"><h4>LATEST NEWS</h4></div>

                  <div class="panel-body">
                      @foreach($newss as $news)
                          <div class="post" id="homepage-news">
                              <hr>
                              <h4>{{$news->title}}</h4>
                              <p>{{substr(strip_tags($news->body),0,300)}} {{strlen(strip_tags($news->body)) > 300 ? "...":""}}</p>
                              <a href="{{route('news.single',$news->id)}}" class="btn btn-primary"> Read more</a>
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

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Upcoming Events</h4></div>

                    <div class="panel-body">
                        <ul>
                            @foreach($events as $event)
                            <li><p><i><a href="{{route('news.single',$event->id)}}">{{$event->title}}<small> - 02/04/2016</small></a></i></p></li>
                            @endforeach
                        </ul>
                        <div class="col-md-8 col-md-offset-2">
                            {!! Html::linkRoute('news.events','See More >>',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Awards</h4></div>

                    <div class="panel-body">
                        <ul>
                            @foreach($awards as $award)
                                <li><p><i><a href="{{route('news.single',$award->id)}}">{{$award->title}}<small> - 02/04/2016</small></a></i></p></li>
                            @endforeach
                        </ul>
                        <div class="col-md-8 col-md-offset-2">
                            {!! Html::linkRoute('news.awards','See More >>',[],['class'=>'btn btn-default bt-h1-spacing btn-block']) !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
