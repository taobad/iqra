@extends('layouts.app')
@section('title','| Start a New Application or retrieve an existing one')
@section('stylesheets')
      {!! Html::style('css/select2.min.css') !!}
      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
      <script>
        tinymce.init({
          selector: 'textarea',
          plugins: 'link',
          menubar: false
        });
      </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create A Fresh Application Form For Admission</h1>
            <hr>
            {!! Form::open(array('route' => 'application.retrieve')) !!}

                <div class="form-group">
                    {{Form::label('application_ref','Enter the code sent to you by the College:')}}
                    {{Form::text('application_ref', null, ['class'=>'form-control'])}}
                </div>

                {{Form::submit('Submit',['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
