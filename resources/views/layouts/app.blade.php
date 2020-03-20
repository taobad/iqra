<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials._head')
    <meta name="google-site-verification" content="2EzqOAe0MbUDJtIrTIHjyI_J1fnGTpg6bWbBS0mkWWw">
</head>

<body>
@include('layouts.partials._nav')
<div class="container-fluid">
    @include('layouts.partials._messages')
    @yield('content')
    @include('layouts.partials._footer')
</div>
@include('layouts.partials._javascript')
</body>
</html>