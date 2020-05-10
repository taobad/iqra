@extends('layouts.app')

@section('title','|All Applications')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h1>All Applications</h1>
        </div>

        <div class="col-md-2 app-button">
              <a href="{{route('application.create')}}" class="btn btn-primary btn-lg btn-block"> Add </a>
        </div>
        <div class="col-md-2 app-button">
             <p><button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Search</button>
        </div>
        <div class="col-md-2 app-button">
            <a href="{{route('application.index')}}" class="btn btn-primary btn-lg btn-block"> Clear Search </a>
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
                    <h4 class="modal-title">Search Applications By Title</h4>
                  </div>
                  <div class="modal-body">
                  <!--<p><input type="text" name="search" id="searchtext" class="form-control"><br></p>-->
                    {!! Form::open(array('route' => 'application.search')) !!}
                      {{Form::text('application_ref',null,['class'=>'form-control'])}}
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
                    <th>Ref</th>
                    <th>Enrolment Centre</th>
                    <th>Created At</th>
                    <th></th>
                </thead>
                @if($applications)
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <th>{{$application->id}}</th>
                            <td>{{$application->application_ref}}</td>
                            <td>{{$application->enrollment_centre}}</td>
                            <td>{{date('M,j,Y',strtotime($application->created_at))}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('application.show',$application->id)}}">View</a> <a class="btn btn-primary btn-sm" href="{{route('application.edit', $application->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

            <div class="text-center">
                {!! $applications->links() !!}
            </div>
        </div>
    </div>
@stop
