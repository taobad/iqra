@extends('layouts.app')

@section('title','|All Applications')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h1>All Applications</h1>
        </div>

        <div class="col-md-2 app-button pull-right">
              <a href="{{route('application.create')}}" class="btn btn-primary btn-lg btn-block"> Add </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                {!! Form::open(array('route' => 'application.search')) !!}
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2">
                            {{Form::label('application_ref','Application Ref')}}
                            {{Form::text('application_ref',null,['class'=>'form-control'])}}
                        </div>
                        <div class="col-md-2">
                            {{Form::label('entry_class','Entry Class')}}
                            <select class="form-control" name="entry_class">
                                <option value="">-- Select Class --</option>
                                @foreach($entry_classes as $class)
                                    <option <?php echo $request->entry_class == $class->id ? "selected=true" : "" ?>
                                            value="{{$class->id}}">{{$class->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            {{Form::label('enrollment_centre','Preferred Exam Centre')}}
                            {{Form::select('enrollment_centre', $enrollment_centres,null,['class' => 'form-control'])}}
                        </div>
                        <div class="col-md-2">
                            {{Form::label('enrollment_type','Enrollment Type')}}
                            {{Form::select('enrollment_type', $enrollment_types,null,['class' => 'form-control'])}}
                        </div>
                        <div class="col-md-2">
                            {{Form::label('gender','Gender')}}
                            {{Form::select('gender', $genders, null,['class' => 'form-control'])}}
                        </div>
                        <div class="col-md-2">
                            {{Form::label('first_name','First Name')}}
                            {{Form::text('first_name',null,['class' => 'form-control input-md'])}}
                        </div>

                        <div class="col-md-2">
                            {{Form::label('last_name','Last Name')}}
                            {{Form::text('last_name',null,['class' => 'form-control input-md'])}}
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    {{Form::submit('Search',['class' => 'btn btn-primary', 'required'=> 'required'])}}
                    <a href="{{route('application.index')}}" class="btn btn-danger"> Clear Search </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <span>Results found: <?php echo $applications->total(); ?></span>
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
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{route('application.show',$application->id)}}">View</a>
                                <a class="btn btn-primary btn-sm"
                                   href="{{route('application.edit', $application->id)}}">Edit</a>
                                <a href="{{route('application.delete',$application->id)}}"
                                   class='btn btn-xs btn-danger'><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
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
