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
                <form action="{{route('contact.post')}}" method="post">
                  {{ csrf_field()}}
                    <div class="form-group">
                        <label name="email">Email:</label>
                        <input id="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label name="subject">Subject:</label>
                        <input id="subject" name="message" class="form-control">
                    </div>

                    <div class="form-group">
                        <label name="message">Message:</label>
                        <textarea id="message" name="message" rows= "6" class="form-control" placeholder="Type your message here"></textarea>
                    </div>

                    <input type="submit" class="btn btn-success" value="submit">
                </form>
          </div>

        </div>
    </div>
@endsection
