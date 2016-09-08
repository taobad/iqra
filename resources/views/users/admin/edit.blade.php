@extends('layouts.app')
@section('title','|Edit User Role')
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
        {!! Form::model($user,['route' => ['users.update',$user->id],'method'=>'PUT','files'=>true]) !!}

        <div class="col-md-5">
            <div class="form-group">
                {{Form::label('firstname','Firstname:')}}
                {{Form::text('firstname',null,['class' => 'form-control input-lg', 'disabled'=> ''])}}
            </div>

            <div class="form-group">
                {{Form::label('lastname','Lastname:')}}
                {{Form::text('lastname',null,['class' => 'form-control input-lg' ,'disabled'=> ''])}}
            </div>

            <div class="form-group">
                {{Form::label('roles','Roles:')}}
                {{Form::select('roles[]',$roles,null,['class' => 'form-control select2-multi','multiple'=>'multiple'])}}
            </div>

            <br>
            <div class="row">
                <div class="col-md-5">
                    {{Form::submit('Save',['class'=>  "btn btn-primary btn-block app-button"  ])}}
                </div>
                <div class="col-md-5 col-md-offset-1">
                    {!! Html::linkRoute('users.show','Cancel',[$user->id],['class'=>'btn btn-danger btn-block app-button']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}
    <script type="text/javascript">
        $('.select2-multi').select2();
        $('.select2-multi').select2().val({!! json_encode($user->roles()->getRelatedIds()) !!}).trigger('change');
    </script>
@endsection
