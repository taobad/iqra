@extends('layouts.app')
@section('title','|Edit Post')
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
        {!! Form::model($post,['route' => ['posts.update',$post->id],'method'=>'PUT','files'=>true]) !!}

        <div class="col-md-8">
            <div class="form-group">
                {{Form::label('title','Title:')}}
                {{Form::text('title',null,['class' => 'form-control input-lg'])}}
            </div>

            <div class="form-group">
                {{Form::label('categories','Categories:')}}
                {{Form::select('categories[]',$categories,null,['class' => 'form-control select2-multi','multiple'=>'multiple'])}}
            </div>

            <div class="form-group">
                {{Form::label('body','Body:')}}
                {{Form::textarea('body',null,['class' => 'form-control'])}}
            </div>

            <div class="form-group">
                {!! Form::label('images','Post Images') !!}
                {!! Form::file('images[]', ['class' => 'form-control','multiple'=>true]) !!}
            </div>
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
