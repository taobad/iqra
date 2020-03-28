<!--Default bootstrap navbar -->
<div class="navbar-panel">
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="row">
            <div class="navbar-header">
                <div class="nav-toggle">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="logo-block">
                    {!! Html::image('img/iqralogo.jpg', 'iqralogo', [ 'style' => "width:60px;height:60px;margin:5px;float:left;"]) !!}
                    <a class="navbar-brand" href="{{route('home')}}">
                        <p class="iqra-font"><span class="title"> IQRA COLLEGE, ILORIN</span><br>
                            <span class="subtitle"> Preparing Students for Global Competitiveness </span>
                        </p></a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="main-nav collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{Request::is('/') ? "active":""}}"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                <li class="{{Request::is('calendar') ? "active":""}}"><a href="{{route('calendar')}}">Calendar</a></li>
                <li class="{{Request::is('about') ? "active":""}}"><a href="{{route('about')}}">About</a></li>
                <li class="{{Request::is('facilities') ? "active":""}}"><a href="{{route('facilities')}}">Facilities</a></li>
                <li class="{{Request::is('news') ? "active":""}}"><a href="{{route('news.index')}}">News</a></li>
                <li class="{{Request::is('admissions') ? "active":""}}"><a href="{{route('admissions')}}">Admissions</a></li>
                <li class="{{Request::is('contact') ? "active":""}}"><a href="{{route('contact.get')}}">Contact Us</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portals<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://schoolreporter.com.ng/app/index.php?url_code=iqrajuniorcollege">JSS</a></li>
                        <li><a href="https://schoolreporter.com.ng/app/index.php?url_code=iqraseniorcollege">SSS</a></li>
                        <li><a href="https://schoolreporter.com.ng/app/index.php?url_code=iqrabasic">IQRA Basic</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome {{Auth::user()->firstname}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    @role('admin')
                        <li><a href="{{route('posts.index')}}">Posts</a></li>
                        <li><a href="{{route('group.index')}}">Groups</a></li>
                        <li><a href="{{route('uploads.get')}}">Uploads</a></li>
                        <li><a href="{{route('users.index')}}">Manage Users</a></li>
                    @endrole
                        <li><a href="{{url('logout')}}">Logout</a></li>
                    </ul>
                </li>
                @else
                    <a href="{{url('login')}}" class="btn btn-default" style="margin-top: 10px">Login</a>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
        </div>
        <div class="row">
            <div class="mobile-nav">
            <ul class="nav nav-tabs">
                <li class="{{Request::is('/') ? "active":""}}"><a href="/"><span title="Home"><i class="glyphicon glyphicon-home"></i> <span class="sr-only">(current)</span></span></a></li>
                <li class="{{Request::is('calendar') ? "active":""}}"><a href="{{route('calendar')}}"><span title="Calendar"><i class="glyphicon glyphicon-calendar"></i></span> </a></li>
                <li class="{{Request::is('about') ? "active":""}}"><a href="{{route('about')}}"><span title="About"><i class="glyphicon glyphicon-info-sign"></i></span> </a></li>
                <li class="{{Request::is('facilities') ? "active":""}}"><a href="{{route('facilities')}}"><span title="Facilities"><i class="glyphicon glyphicon-scale"></i></span></a></li>
                <li class="{{Request::is('admissions') ? "active":""}}"><a href="{{route('admissions')}}"><span title="Admissions"><i class="glyphicon glyphicon-folder-open"></i></span></a></li>
                <li class="{{Request::is('news') ? "active":""}}"><a href="{{route('news.index')}}"><span title="News"><i class="glyphicon glyphicon-list-alt"></i></span></a></li>
                <li class="{{Request::is('contact') ? "active":""}}"><a href="{{route('contact.get')}}"><span title="Contact Us"><i class="glyphicon glyphicon-phone-alt"></i></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span title="Portals"><i class="glyphicon glyphicon-chevron-down"></i></span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://schoolreporter.com.ng/app/index.php?url_code=iqrajuniorcollege">JSS</a></li>
                        <li><a href="https://schoolreporter.com.ng/app/index.php?url_code=iqraseniorcollege">SSS</a></li>
                        <li><a href="https://schoolreporter.com.ng/app/index.php?url_code=iqrabasic">IQRA Basic</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>
</div>
@section('scripts')
    <script type="text/javascript">
        var toggleNavMode = function() {
            var isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

            if (isMobile) {
                $('.mobile-nav').show();
                $('.main-nav, .nav-toggle').hide();
            } else {
                $('.mobile-nav').hide();
                $('.main-nav, .nav-toggle').show();
            }
        };

        $( document ).ready(function() {
           toggleNavMode();
        });
        $(window).resize(function() {
            toggleNavMode();
        }).resize()
    </script>
@endsection
