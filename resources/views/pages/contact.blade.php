@extends('layouts.app')
@section('title','| Contact')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Talk to us</div>

                <div class="panel-body">
                    <p><span class="glyphicon glyphicon-phone-alt"></span> +234-31227078</p>
                    <p><span class="glyphicon glyphicon-earphone"></span> +234-8037060622</p>
                    <p><span class="glyphicon glyphicon-envelope"></span> info@iqracollege.net</p>
                </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Meet Us</div>

                <div class="panel-body">
                    <p><i>Near Pilgrims Camp,
                          Transit Camp Layout,
                          P.O. Box 5082,
                          Ilorin, Kwara State.
                    </i></p>
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <h1>Contact Us</h1>
            <hr>
            {!! Form::open(array('route' => 'contact.post')) !!}

                <div class="form-group">
                    {{Form::label('email','Email:')}}
                    {{Form::text('email',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('subject','Subject:')}}
                    {{Form::text('subject',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('message','Message:')}}
                    {{Form::textarea('message',null,['class'=>'form-control'])}}
                </div>

                {{Form::submit('Send Message',['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
            {!! Form::close() !!}

          </div>

        </div>
    </div>
@endsection
