@extends('layouts.app')
@section('title','| Add Document')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New Post</h1>
            <hr>
            {!! Form::open(array('route' => 'documents.store', 'files'=>true )) !!}

                <div class="form-group">
                    {{Form::label('name','Name:')}}
                    {{Form::text('name',null,['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('class_id','Class:')}}
                    <select class="form-control" name="class_id">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{Form::label('document_type_id','Document Type:')}}
                    <select class="form-control" name="document_type_id">
                        @foreach($documentTypes as $documentType)
                            <option value="{{$documentType->id}}">{{$documentType->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{Form::label('link','Document Link:')}}
                    {{Form::text('link',null,['class'=>'form-control'])}}
                </div>

                {{Form::submit('Add',['class' => 'btn btn-primary btn-lg btn-block','style' => 'margin-top:20px'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

