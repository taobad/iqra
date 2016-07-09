@extends('layouts.app')
@section('title','|Edit Post')
@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
    <div class="row">
        {!! Form::model($post,['route' => ['posts.update',$post->id],'method'=>'PUT']) !!}
        <div class="col-md-8">
            {{Form::label('title','Title:')}}
            {{Form::text('title',null,['class' => 'form-control input-lg'])}}
            <br>
            {{Form::label('categories','Categories:')}}
            {{Form::select('categories[]',$categories,null,['class' => 'form-control select2-multi','multiple'=>'multiple'])}}
            <br>
            {{Form::label('body','Body:')}}
            {{Form::textarea('body',null,['class' => 'form-control'])}}
            <br>
            <div class="row">
                <div class="row col-sm-5 col-sm-offset-1">
                    {{Form::submit('Save',['class'=>  "btn btn-primary btn-block" ])}}
                </div>
                <div class="row col-sm-5 col-sm-offset-1">
                    {!! Html::linkRoute('posts.show','Cancel',[$post->id],['class'=>'btn btn-danger btn-block']) !!}
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
        $('.select2-multi').select2().val({!! json_encode($post->categories()->getRelatedIds()) !!}).trigger('change');
    </script>
@endsection