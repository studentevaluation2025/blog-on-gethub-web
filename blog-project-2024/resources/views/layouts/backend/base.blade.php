<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.backend.site-css')

    <title>
        
    @yield('title')

</title>

</head>
<body>
    @include('layouts.backend.header')
    @include('layouts.backend.aside')
    @yield('content')
    @include('layouts.backend.footer')
    @include('layouts.backend.site-js')
</body>
</html>
