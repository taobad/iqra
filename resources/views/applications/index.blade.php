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
                        <div class="col-md-3">
                            {{Form::label('application_ref','Application Ref')}}
                            {{Form::text('application_ref',null,['class'=>'form-control'])}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label('first_name','First Name')}}
                            {{Form::text('first_name',null,['class' => 'form-control input-md'])}}
                        </div>

                        <div class="col-md-3">
                            {{Form::label('last_name','Last Name')}}
                            {{Form::text('last_name',null,['class' => 'form-control input-md'])}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label('entry_class','Entry Class')}}
                            <select class="form-control" name="entry_class">
                                <option value="">-- Select Class --</option>
                                @foreach($entry_classes as $class)
                                    <option <?php echo $request->entry_class == $class->id ? "selected=true" : "" ?>
                                            value="{{$class->id}}">{{$class->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            {{Form::label('enrollment_centre','Preferred Exam Centre')}}
                            {{Form::select('enrollment_centre', $enrollment_centres,null,['class' => 'form-control'])}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label('enrollment_type','Enrollment Type')}}
                            {{Form::select('enrollment_type', $enrollment_types,null,['class' => 'form-control'])}}
                        </div>
                        <div class="col-md-3">
                            {{Form::label('gender','Gender')}}
                            {{Form::select('gender', $genders, null,['class' => 'form-control'])}}
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
        <button id="download_btn" class="pull-right" style="padding: 5px; margin-right: 10px;"><i class="fa fa-download"></i> Download</button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <span><b>Results found: <?php echo $applications->total(); ?></b></span>
            <table class="table" id="admission_report_content">
                <thead>
                <th>#</th>
                <th>Ref</th>
                <th>Applicant's Name</th>
                <th>Entry Class</th>
                <th>Preferred Exam Centre</th>
                <th>Enrollment Type</th>
                <th>Gender</th>
                <th>Contact Numbers</th>
                <th>Created At</th>
                <th></th>
                </thead>
                @if($applications)
                    <tbody>
                    @foreach($applications as $index => $application )
                        <tr>
                            <th>{{$index + 1}}</th>
                            <td>{{$application->application_ref}}</td>
                            <td>{{$application->first_name . ' '. $application->other_names. ' '. $application->last_name}}</td>
                            <td><?php
                                foreach ($entry_classes as $class) {

                                    if ($application->entry_class == $class->id)
                                        echo $class->name;
                                }
                                ?></td>
                            <td><?php
                                foreach ($enrollment_centres as $centre => $value) {

                                    if ($application->enrollment_centre == $centre)
                                        echo $value;
                                }
                                ?></td></td>
                            <td><?php
                                foreach ($enrollment_types as $type => $value) {

                                    if ($application->enrollment_type == $type)
                                        echo $value;
                                }
                                ?></td>
                            <td><?php
                                foreach ($genders as $gender_key => $value) {

                                    if ($application->gender == $gender_key)
                                        echo $value;
                                }
                                ?></td>
                            <td><p>Father: {{$application->father_mobile_phone}}</p>
                                <p>Mother: {{$application->mother_mobile_phone}}</p>
                                <p>Sponsor: {{$application->sponsor_mobile_phone}}</p></td>
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
                {!! $applications->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.1/jspdf.plugin.autotable.min.js"></script>
    <script>
        $('#download_btn').on('click', function () {
            // var doc = new jsPDF('p', 'mm');
            // doc.save("admission_report.pdf")

            var doc = new jsPDF('l', 'pt');
            var res = doc.autoTableHtmlToJson(document.getElementById('admission_report_content'));
            doc.autoTable(res.columns, res.data);
            // doc.autoTable(res.columns, res.data, {
            //     startY: doc.autoTableEndPosY() + 50
            // });
            // var height = doc.internal.pageSize.height;
            // doc.autoTable(res.columns, res.data, {
            //     startY: height,
            //     afterPageContent: function(data) {
            //         doc.setFontSize(20)
            //         doc.text("After page content", 50, height - data.settings.margin.bottom - 20);
            //     }
            // });
            doc.save("admission_report.pdf")


        });
    </script>
@endsection
