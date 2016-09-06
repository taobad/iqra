@extends('layouts.app')
@section('title','| Contact')
@section('content')    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Contact me</h1>
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
@endsection
