@extends('layouts.app')
@section('title','| Contact')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Talk to us</div>

                <div class="panel-body">
                    <p><span class="glyphicon glyphicon-earphone"></span> +234-8039447200, +234-8056646541</p>
                    <p><span class="fa fa-whatsapp"></span> +234-8039447200</p>
                    <p><span class="glyphicon glyphicon-envelope"></span> info@iqracollege.net</p>
                    <p><i class="fa fa-facebook"></i> IQRA College Ilorin</p>
                    <p><i class="fa fa-instagram"></i> @iqracollegeilorin</p>
                    <p><i class="fa fa-twitter"></i> @iqracollegeilr</p>
                </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Meet Us</div>

                <div class="panel-body">
                    <p><i>IQRA College, Adebayo Ojuolape Street, Islamic Village, Near Pilgrims Camp,
                          Transit Camp Layout, Ilorin
                          P.O. Box 5082, Kwara State.
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
