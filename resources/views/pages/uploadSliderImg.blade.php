@extends('layouts.app')
@section('title','| About')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
          {!! Form::open(array('route' => 'uploadsliderimages.post', 'files'=>true, 'enctype'=>"multipart/form-data" )) !!}
              <div class="form-group">
                  {!! Form::label('images','Homepage Slider Images') !!}
                  {!! Form::file('images[]',['class' => 'form-control','multiple'=>true]) !!}
              </div>
              {{Form::submit('Upload Slider Images', ['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
          {!! Form::close() !!}
        </div>
    </div>
@endsection
