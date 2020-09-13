@extends('layouts.app')

@section('title','| View Application')

@section('content')
    <!-- Tab links -->
    <div class="tab">
        <button class="tablinks active" id="enrollment_details">Application Details</button>
        <?php if($application->status == '2') { ?>
        <button class="tablinks" id="past_question">Past Question Papers</button>
        <button class="tablinks" id="exam_details">Exam Details</button>
        <button class="tablinks" id="result">Result</button>
        <?php } ?>
    </div>

    <!-- Tab content -->
    <div id="enrollment_details_block" class="tabcontent">
        <div class="panel panel-default">
            <h3 style="margin-left: 10px;"><u>Enrollment Details</u></h3>

            <div class="panel-body">
                <div class="col-md-6">
                    <div class="row">
                <div class="col-md-12">
                    <label>Application Reference: </label>
                    <span><?php echo $application->application_ref ?></span>
                </div>
                <div class="col-md-12">
                    <label>Entry Class: </label>
                    <span><?php
                        foreach ($entry_classes as $class) {

                            if ($application->entry_class == $class->id)
                                echo $class->name;
                        }
                        ?></span>
                </div>
                <div class="col-md-12">
                    <label>Enrollment Type: </label>
                    <span><?php echo $application->enrollment_type ?></span>
                </div>
                <div class="col-md-12">
                    <?php if ($application->enrollment_centre == 'ilorin') {
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
                    <label>Preferred Exam Centre: </label>
                    <span><?php echo $text ?></span>
                </div>
                    </div>
                </div>
                <div class="col-md-6 pull-right">
                    {!! Html::image("img/admission/$application->application_ref/$application->image_name", 'image',
                    ['data-u' => 'image', 'width' => 200, 'height' => 200]) !!}
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <h3 style="margin-left: 10px;"><u>Applicant's Details</u></h3>
            <div class="panel-body">
                <div class="col-md-6">
                    <label>First Name:</label>
                    <span><?php echo $application->first_name ?></span>
                </div>
                <div class="col-md-6">
                    <label>Last Name:</label>
                    <span><?php echo $application->last_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Other Names:</label>
                    <span><?php echo $application->other_names ?></span>
                </div>

                <div class="col-md-6">
                    <label>Gender:</label>
                    <span><?php echo $application->gender ?></span>
                </div>

                <div class="col-md-6">
                    <label>Date Of Birth:</label>
                    <span><?php echo $application->date_of_birth ?></span>
                </div>
                <div class="col-md-6">
                    <label>Place Of Birth:</label>
                    <span><?php echo $application->place_of_birth ?></span>
                </div>

                <div class="col-md-6">
                    <label>Previous School: </label>
                    <span><?php echo $application->previous_school ?></span>
                </div>

                <div class="col-md-6">
                    <label>Reason for Leaving: </label>
                    <span><?php echo $application->reason_for_leaving ?></span>
                </div>

                <div class="col-md-6">
                    <label>Individual Peculiarity:</label>
                    <span><?php echo $application->individual_peculiarity ?></span>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <h3 style="margin-left: 10px;"><u>Father's Details</u></h3>

            <div class="panel-body">

                <div class="col-md-6">
                    <label>First Name: </label>
                    <span><?php echo $application->father_first_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Last Name: </label>
                    <span><?php echo $application->father_last_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Other Names: </label>
                    <span><?php echo $application->father_other_names ?></span>
                </div>

                <div class="col-md-6">
                    <label>Mobile Phone: </label>
                    <span><?php echo $application->father_mobile_phone ?></span>
                </div>

                <div class="col-md-6">
                    <label>Home Phone: </label>
                    <span><?php echo $application->father_home_phone ?></span>
                </div>

                <div class="col-md-6">
                    <label>Postal Code: </label>
                    <span><?php echo $application->father_postal_code ?></span>
                </div>

                <div class="col-md-6">
                    <label>Contact Address: </label>
                    <span><?php echo $application->father_contact_address ?></span>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <h3 style="margin-left: 10px;"><u>Mother's Details</u></h3>

            <div class="panel-body">

                <div class="col-md-6">
                    <label>First Name: </label>
                    <span><?php echo $application->mother_first_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Last Name: </label>
                    <span><?php echo $application->mother_last_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Other Names: </label>
                    <span><?php echo $application->mother_other_names ?></span>
                </div>

                <div class="col-md-6">
                    <label>Mobile Phone: </label>
                    <span><?php echo $application->mother_mobile_phone ?></span>
                </div>

                <div class="col-md-6">
                    <label>Home Phone: </label>
                    <span><?php echo $application->mother_home_phone ?></span>
                </div>

                <div class="col-md-6">
                    <label>Postal Code: </label>
                    <span><?php echo $application->mother_postal_code ?></span>
                </div>

                <div class="col-md-6">
                    <label>Contact Address: </label>
                    <span><?php echo $application->mother_contact_address ?></span>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <h3 style="margin-left: 10px;"><u>Enrollment Details</u></h3>

            <div class="panel-body">
                <div class="col-md-6">
                    <label>First Name: </label>
                    <span><?php echo $application->sponsor_first_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Last Name: </label>
                    <span><?php echo $application->sponsor_last_name ?></span>
                </div>

                <div class="col-md-6">
                    <label>Other Names: </label>
                    <span><?php echo $application->sponsor_other_names ?></span>
                </div>

                <div class="col-md-6">
                    <label>Mobile Phone: </label>
                    <span><?php echo $application->sponsor_mobile_phone ?></span>
                </div>

                <div class="col-md-6">
                    <label>Home Phone: </label>
                    <span><?php echo $application->sponsor_home_phone ?></span>
                </div>

                <div class="col-md-6">
                    <label>Postal Code: </label>
                    <span><?php echo $application->sponsor_postal_code ?></span>
                </div>

                <div class="col-md-6">
                    <label>Contact Address: </label>
                    <span><?php echo $application->sponsor_contact_address ?></span>
                </div>
            </div>
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
    <div id="exam_details_block" class="tabcontent">
        <?php
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
            <div class="col-md-9" style="margin-bottom: 10px">
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
    </div>
    <div id="result_block" class="tabcontent">
        <div class="row">
            <div class="col-md-6">
                <label>Score: </label>
                <span><?php echo $application->score ?> </span>
            </div>

            <div class="col-md-6">
                <label>Remark: </label>
                <span><?php echo $application->remark?></span>
            </div>
        </div>
    </div>
    <?php } ?>

@endsection

@section('scripts')
    <script>
        $('.tablinks').on('click', function () {
            if (!$(this).hasClass("active")) {
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
        $('.tablinks.active').on('ready', function () {
            var block_name = $(this).attr('id') + '_block';
            document.getElementById(block_name).style.display = "block";
        }).trigger('ready');

    </script>
@endsection
