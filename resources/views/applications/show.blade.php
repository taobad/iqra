@extends('layouts.app')

@section('title','| View Application')

@section('content')
    <!-- Tab links -->
    <div class="tab">
        <button class="tablinks active" id="enrollment_details">Enrollment Details</button>
        <button class="tablinks" id="applicant_details">Applicant</button>
        <button class="tablinks" id="father">Father</button>
        <button class="tablinks" id="mother">Mother</button>
        <button class="tablinks" id="sponsor">Sponsor</button>
        <button class="tablinks" id="review">Review / Result</button>
        <button class="tablinks" id="past_question">Past Question Papers</button>
    </div>

    {!! Form::model($application,['route' => ['application.update',$application->id],'method'=>'PUT','files'=>true]) !!}

    <!-- Tab content -->
    <div id="enrollment_details_block" class="tabcontent">

        <div class="form-group">
            {{Form::label('application_ref','Application Ref:')}}
            {{Form::text('application_ref',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('entry_class','Entry Class:')}}
            <select class="form-control" name="entry_class" disabled>
                @foreach($entry_classes as $class)
                    <option <?php echo $application->entry_class == $class->id ? "selected=true" : "" ?>
                     value="{{$class->id}}">{{$class->name}} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{Form::label('enrollment_type','Enrollment Type:')}}
            {{Form::select('enrollment_type', $enrollment_types,null,['class' => 'form-control', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('enrollment_centre','Preferred Exam Centre:')}}
            {{Form::select('enrollment_centre', $enrollment_centres,null,['id'=> 'enrollment_centre', 'class' => 'form-control', 'disabled'=> true])}}
        </div>

        <p id="exam_centre_details"></p>
    </div>

    <div id="applicant_details_block" class="tabcontent">
        <div class="form-group">
            {{Form::label('first_name','First Name:')}}
            {{Form::text('first_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('last_name','Last Name:')}}
            {{Form::text('last_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('other_names','Other Names:')}}
            {{Form::text('other_names',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('gender','Gender:')}}
            {{Form::select('gender', $genders, null,['class' => 'form-control', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('date_of_birth','Date Of Birth')}}
            {{Form::date('date_of_birth',null,['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('place_of_birth','Place Of Birth:')}}
            {{Form::text('place_of_birth',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('previous_school','Previous School')}}
            {{Form::text('previous_school',null,['class' => 'form-control', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('reason_for_leaving','Reason for Leaving')}}
            {{Form::textarea('reason_for_leaving',null,['class' => 'form-control', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('individual_peculiarity','Individual Peculiarity')}}
            {{Form::textarea('individual_peculiarity',null,['class' => 'form-control', 'disabled'=> true])}}
        </div>

        {!! Html::image("img/admission/$application->application_ref/$application->image_name", 'image', ['data-u' => 'image']) !!}

    </div>

    <div id="father_block" class="tabcontent">
        <div class="form-group">
            {{Form::label('father_first_name','First Name:')}}
            {{Form::text('father_first_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('father_last_name','Last Name:')}}
            {{Form::text('father_last_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('father_other_names','Other Names:')}}
            {{Form::text('father_other_names',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('father_mobile_phone','Mobile Phone:')}}
            {{Form::text('father_mobile_phone',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('father_home_phone','Home Phone:')}}
            {{Form::text('father_home_phone',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('father_postal_code','Postal Code:')}}
            {{Form::text('father_postal_code',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('father_contact_address','Contact Address')}}
            {{Form::textarea('father_contact_address',null,['class' => 'form-control', 'disabled'=> true])}}
        </div>
    </div>

    <div id="mother_block" class="tabcontent">
        <div class="form-group">
            {{Form::label('mother_first_name','First Name:')}}
            {{Form::text('mother_first_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('mother_last_name','Last Name:')}}
            {{Form::text('mother_last_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('mother_other_names','Other Names:')}}
            {{Form::text('mother_other_names',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('mother_mobile_phone','Mobile Phone:')}}
            {{Form::text('mother_mobile_phone',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('mother_home_phone','Home Phone:')}}
            {{Form::text('mother_home_phone',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('mother_postal_code','Postal Code:')}}
            {{Form::text('mother_postal_code',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('mother_contact_address','Contact Address')}}
            {{Form::textarea('mother_contact_address',null,['class' => 'form-control', 'disabled'=> true])}}
        </div>
    </div>

    <div id="sponsor_block" class="tabcontent">
        <div class="form-group">
            {{Form::label('sponsor_first_name','First Name:')}}
            {{Form::text('sponsor_first_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_last_name','Last Name:')}}
            {{Form::text('sponsor_last_name',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_other_names','Other Names:')}}
            {{Form::text('sponsor_other_names',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_relationship','Relationship with the Applicant:')}}
            {{Form::text('sponsor_relationship',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_mobile_phone','Mobile Phone:')}}
            {{Form::text('sponsor_mobile_phone',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_home_phone','Home Phone:')}}
            {{Form::text('sponsor_home_phone',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_postal_code','Postal Code:')}}
            {{Form::text('sponsor_postal_code',null,['class' => 'form-control input-md', 'disabled'=> true])}}
        </div>

        <div class="form-group">
            {{Form::label('sponsor_contact_address','Contact Address')}}
            {{Form::textarea('sponsor_contact_address',null,['class' => 'form-control', 'disabled'=> true])}}
        </div>
    </div>

    <?php if($application->status == '2') { ?>
    <div id="past_question_block" class="tabcontent">
        <ul>
            @foreach($documents as $document)
                <li><a class="btn btn-link" target="_blank" href="{{ $document->link }}">{{$document->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <?php } ?>

    <div id="review_block" class="tabcontent">

        <?php if(!(Auth::user() && Auth::user()->hasRole('admin'))) { ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <input type="checkbox" id="agree" name="agree" value="1">
                    <label for="agree">I hereby declare that I wish my child to attend IQRA College, Ilorin,
                        that the information provided on this form are to the best of my knowledge correct,
                        that I will ensure the regular payments of his/her fees on or before the second week of each
                        term;
                        and that I shall cooperate fully with the school for his/her proper upbringing and the
                        attainment of the overall objectives of the school</label><br>
                </div>
            </div>
        </div>

        {{Form::submit('Save',['class'=>  "btn btn-primary btn-block" ])}}
        <?php } ?>
        <?php if($application->status == '2') {
        if ($application->enrollment_centre == 'ilorin') {
            $text = 'IQRA College, Ilorin, Adebayo Ojuolape Street, Islamic Village, Near Pilgrims Camp, Ilorin. 08039447200, 08056646541';
        } else if ($application->enrollment_centre == 'abuja') {
            $text = 'Model Islamic Schools, Queen Amina Way, Phase 2, Site 2 (2/2), Kubwa, Abuja. 08023571765, 08120613391';
        } else if ($application->enrollment_centre == 'lagos') {
            $text = 'Faridah Children’s School, 344 Murtala Muhammed Way, Yaba, Lagos. 08027865577';
        } else if ($application->enrollment_centre == 'port-harcout') {
            $text = 'Zenith School, 1 Endless Extension, Ogbatai, Woji, Port-Harcourt. 08035383897';
        } else if ($application->enrollment_centre == 'warri') {
            $text = 'Ummatul-Islam Islamiyya, Refinery Drive, NNPC Housing Complex, Ekpan, Warri. 080535571134';
        } else {
            $text = '';
        }?>

        <div class="row">
            <div class="col-md-9"  style="margin-bottom: 10px">
                <label>You have successfully submitted your Application Form For Admission.
                    Examination date is 24th October 2020</label>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Exam Centre</div>

                    <div class="panel-body">
                        <p><i><?php echo $text; ?></i></p>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>


        <?php if($application->score) { ?>
        <div class="form-group">
            {{Form::label('score','Score:')}}
            {{Form::text('score',null,['class' => 'form-control input-md', 'disabled' => true ])}}
        </div>

        <div class="form-group">
            {{Form::label('remark','Remark:')}}
            {{Form::select('remark', $remarks, null,['class' => 'form-control', 'disabled' => true ])}}
        </div>
        <?php } ?>
    </div>

    {!! Form::close() !!}

@endsection

@section('scripts')
    <script>
        $('.tablinks').on('click', function(){
            if(!$(this).hasClass("active")) {
                // Declare all variables
                var i, tabcontent, tablinks;

                // Get all elements with class="tabcontent" and hide them
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Get all elements with class="tablinks" and remove the class "active"
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                var block_name = $(this).attr('id') + '_block';
                document.getElementById(block_name).style.display = "block";

                $(this).addClass("active");
            }

        });
        $('.tablinks.active').on('ready', function(){
            var block_name = $(this).attr('id') + '_block';
            document.getElementById(block_name).style.display = "block";
        }).trigger('ready');

    </script>
@endsection
