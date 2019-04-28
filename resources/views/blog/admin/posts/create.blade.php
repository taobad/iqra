@extends('layouts.app')
@section('title','| Create New Post')
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
            <h1>Create New Post</h1>
            <hr>
            {!! Form::open(array('route' => 'posts.store', 'files'=>true )) !!}

                <div class="form-group">
                    {{Form::label('title','Title:')}}
                    {{Form::text('title',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('categories','Categories:')}}
                    <select class="form-control select2-multi" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{Form::label('eventdate','Event Date:')}}
                    <input name="eventdate" type="date">
                </div>

                <div class="form-group">
                    {{Form::label('body','Post Body:')}}
                    {{Form::textarea('body',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {!! Form::label('images','Post Images') !!}
                    {!! Form::file('images[]',['class' => 'form-control','multiple'=>true]) !!}
                </div>

                {{Form::submit('Create Post',['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection
