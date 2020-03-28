@extends('layouts.app')
@section('title','|Edit User Role')
@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection

@section('content')
    <div class="row">
        {!! Form::model($group,['route' => ['group.update',$group->id],'method'=>'PUT','files'=>true]) !!}

        <div class="col-md-5">
            <div class="form-group">
                {{Form::label('name','Name:')}}
                {{Form::text('name',null,['class' => 'form-control input-lg','disabled'=> ''])}}
            </div>

            <div class="form-group">
                {{Form::label('display_name','display Name:')}}
                {{Form::text('display_name',null,['class' => 'form-control input-lg'])}}
            </div>

            <div class="form-group">
                {{Form::label('description','description:')}}
                {{Form::text('description',null,['class' => 'form-control input-lg'])}}
            </div>

            <br>
            <div class="row">
                <div class="col-md-5">
                    {{Form::submit('Save',['class'=>  "btn btn-primary btn-block app-button"  ])}}
                </div>
                <div class="col-md-5 col-md-offset-1">
                    {!! Html::linkRoute('users.show','Cancel',[$group->id],['class'=>'btn btn-danger btn-block app-button']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
