@extends('layouts.app')
@section('title','|Edit Document')

@section('content')
    <div class="row">
        {!! Form::model($document,['route' => ['documents.update',$document->id],'method'=>'PUT','files'=>true]) !!}

        <div class="col-md-8">
            <div class="form-group">
                {{Form::label('name','Name:')}}
                {{Form::text('name',null,['class'=>'form-control'])}}
            </div>

            <div class="form-group">
                {{Form::label('class_id','Class:')}}
                <select class="form-control" name="class_id">
                    <option value=""> -- Select Class --</option>
                    @foreach($classes as $class)
                        <option <?php echo $document->class_id == $class->id ? "selected=true" : "" ?>
                                value="{{$class->id}}">{{$class->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {{Form::label('document_type_id','Document Type:')}}
                <select class="form-control" name="document_type_id">
                    @foreach($documentTypes as $documentType)
                        <option <?php echo $document->document_type_id == $documentType->id ? "selected=true" : "" ?>
                                value="{{$documentType->id}}">{{$documentType->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {{Form::label('link','Document Link:')}}
                {{Form::text('link',null,['class'=>'form-control'])}}
            </div>
            <br>
            <div class="row">
                <div class="row col-sm-5 col-sm-offset-1">
                    {{Form::submit('Save',['class'=>  "btn btn-primary btn-block" ])}}
                </div>
                <div class="row col-sm-5 col-sm-offset-1">
                    {!! Html::linkRoute('documents.index','Cancel',[$document->id],['class'=>'btn btn-danger btn-block']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
