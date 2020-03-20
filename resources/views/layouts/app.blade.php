<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials._head')
    <meta name="google-site-verification" content="GSQGqilUs-AbA-Gm_fFmugoZOiUy3aNd5cYKJX9UZY4">
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