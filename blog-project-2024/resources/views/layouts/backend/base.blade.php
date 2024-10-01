<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.site-css')

    <title>
        
    @yield('title')

</title>

</head>
<body>
    @include('layouts.header')
    @include('layouts.aside')
    @yield('content')
    @include('layouts.footer')
    @include('layouts.site-js')
</body>
</html>
