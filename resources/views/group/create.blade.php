@extends('layouts.app')
@section('title','| Add New Group')
@section('stylesheets')
      {!! Html::style('css/select2.min.css') !!}
      <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Add New Group</h1>
            <hr>
            {!! Form::open(array('route' => 'group.store', 'files'=>true, 'class' => 'form-horizontal' )) !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                    <label for="display_name" class="col-md-4 control-label">Display Name</label>

                    <div class="col-md-6">
                        <input id="display_name" type="text" class="form-control" name="display_name" value="{{ old('display_name') }}">

                        @if ($errors->has('display_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('display_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                {{Form::submit('Create Group',['class' => 'app-button btn btn-primary btn-lg','style' => 'margin:auto; display:block;'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
