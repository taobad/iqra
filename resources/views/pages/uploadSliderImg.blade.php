@extends('layouts.app')
@section('title','| About')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <?php $slider_positions = [1,2,3,4,5]; ?>
            @foreach($slider_positions as $slider_position)
<div class="panel panel-default">
    <div class="panel-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        {!! Form::open(array('route' => 'uploadsliderimages.post', 'files'=>true, 'enctype'=>"multipart/form-data" )) !!}
                        <div class="form-group">
                            {!! Form::label('images',"Homepage Slider Image $slider_position") !!}
                            {!! Form::file('images[]',['class' => 'form-control','multiple'=>false]) !!}
                            {{Form::hidden('position', $slider_position) }}
                            {{Form::submit("Upload Slider Image $slider_position", ['class' => 'btn btn-primary btn-sm','style' => 'margin-top:5px'])}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
</div>
</div>
            @endforeach
        </div>
        <div class="col-md-6">
<div class="panel panel-default">
    <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  {!! Form::open(array('route' => 'uploadsliderimages.post', 'files'=>true, 'enctype'=>"multipart/form-data" )) !!}
                      <div class="form-group">
                          {!! Form::label('images','Upload All Homepage Slider Images') !!}
                          {!! Form::file('images[]',['class' => 'form-control','multiple'=>true]) !!}
                          {{Form::hidden('position', 'ALL') }}
                      </div>
                      {{Form::submit('Upload Slider Images', ['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  {!! Form::open(array('route' => 'uploadsliderimages.post', 'files'=>true, 'enctype'=>"multipart/form-data" )) !!}
                      <div class="form-group">
                          {!! Form::label('images','Upload All Homepage Slider Images') !!}
                          {!! Form::file('images[]',['class' => 'form-control','multiple'=>true]) !!}
                          {{Form::hidden('position', 'ALL') }}
                      </div>
                      {{Form::submit('Upload Slider Images', ['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
</div>
</div>
    </div>
@endsection
