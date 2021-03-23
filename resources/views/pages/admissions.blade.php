@extends('layouts.app')

@section('title',"| Admissions")
@section('content')
<div class="row">
    <div class="col-md-3" style="margin: 15px; padding-bottom: 15px;  background: lightgray">
        <div class="post">
            <h3 style="text-transform: uppercase"><b>Online Application Form For Admission</b></h3>
            <p> To complete an online application form, pay N6000 into our bank account and send evidence of payment to +234 803 944 7200. A code will be sent to the telephone line through which you sent payment evidence. You will then tap the blue bar below to enter the code and complete the form. In case you are purchasing more than one form, repeat the process for each.</p>
            <p>NOTES</p>
            <ol>
                <li>Entrance examination holds on Saturday 1st of May 2021</li>
                <li>Keep handy the code sent to you by the College as you will need it to check the entrance examination result</li>
                <li>Bank Account Details</li>
                <ol type="a">
                    <li>IQRA College, Ilorin
                        Jaiz Bank
                        0002544948</li>
                    <li>IQRA College, Ilorin
                        UBA
                        1017303632</li>
                </ol>
                <li>Evidence of Payment</li>
                <ol type="a">
                    <li>Teller (pay-in slip) reference number with our bank’s name and payment date</li>
                    <li>Fund transfer reference number with our bank’s name and payment date</li>
                </ol>
                <li>Application Form fee is N7500 if group entrance examination has closed and the candidate will take individual exam</li>
                <li>Download Past Questions for the candidate to practice by clicking on the ’Past Question Papers’ icon</li>
            </ol>
            <a href="{{route('application.prospect')}}" class="btn btn-primary btn-lg btn-block">Start/Retrieve an Application</a>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-1">
        <div class="row">
            <div class="col-md-12">
                <h1>Latest Admissions News</h1>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $post)
            <div class="post">
                <h2>{{$post->title}}</h2>
                <h5>Published: {{date('M,j,Y h:ia',strtotime($post->created_at))}}</h5>
                <p>{{substr(strip_tags($post->body),0,300)}} {{strlen(strip_tags($post->body)) > 300 ? "...":""}}</p>
                <a href="{{route('news.single',$post->id)}}" class="btn btn-primary"> Read More...</a>
            </div>
            <hr>
            @endforeach
        </div>
        <div class="text-center">
            {!! $posts->links() !!}
        </div>
    </div>
</div>

@stop