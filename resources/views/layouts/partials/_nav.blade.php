<!--Default bootstrap navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" class="color: #fff;" href="{{route('home')}}"> {!! Html::image('img/iqracollege.png', 'Iqra College Ilorin', ['width' => 160,'height'=> 30]) !!} </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{Request::is('/') ? "active":""}}"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                <li class="{{Request::is('calendar') ? "active":""}}"><a href="{{route('calendar')}}">Calendar</a></li>
                <li class="{{Request::is('news') ? "active":""}}"><a href="{{route('news.index')}}">News</a></li>
                <li class="{{Request::is('about') ? "active":""}}"><a href="{{route('about')}}">About</a></li>
                <li class="{{Request::is('contact') ? "active":""}}"><a href="{{route('contact.get')}}">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome {{Auth::user()->firstname}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    @role('admin')
                        <li><a href="{{route('posts.index')}}">Posts</a></li>
                        <li><a href="{{route('uploadsliderimages.get')}}">Upload Slider Images</a></li>
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
    </div><!-- /.container-fluid -->
</nav>
