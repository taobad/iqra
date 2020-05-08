@extends('layouts.app')

@section('title','|All Documents')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>All Documents</h1>
        </div>


        <div class="col-md-2 app-button">
            <a href="{{route('documents.create')}}" class="btn btn-primary btn-lg btn-block"> Add Document</a>
        </div>
        <div class="col-md-2 app-button">
            <p><button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Search Documents</button>
        </div>

        <div class="col-md-12">
            <hr>
                  <!-- Modal -->
            <div id="myModal" class="modal fade col-md-6 col-md-offset-3" role="dialog">
              <div class="modal-dialog">

               <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Search Documents By Name</h4>
                  </div>
                  <div class="modal-body">
                  <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                    {!! Form::open(array('route' => 'documents.search')) !!}
                      {{Form::text('name',null,['class'=>'form-control'])}}
                  </div>
                  <div class="modal-footer">
                      {{Form::submit('Search',['class' => 'btn btn-primary', 'required'=> 'required'])}}
                      {{Form::button('Close',['class' => 'btn btn-danger','data-dismiss' => 'modal'])}}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Class</th>
                    <th>Date Added</th>
                    <th></th>
                </thead>
                @if($documents)
                <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <th>{{$document->id}}</th>
                            <td>
                                <a class="btn btn-link" target="_blank" href="{{ $document->link }}">{{$document->name}}</a>
                            </td>
                            <td>{{$document->documentType->name}}</td>
                            <td>{{$document->assignedClass->name}}</td>
                            <td>{{date('M,j,Y',strtotime($document->created_at))}}</td>
                            <td> <a class="btn btn-primary btn-sm" href="{{route('documents.edit', $document->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

            <div class="text-center">
                {!! $documents->links() !!}
            </div>
        </div>
    </div>
@stop
