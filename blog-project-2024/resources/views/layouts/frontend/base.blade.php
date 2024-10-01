<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
        
        @yield('page-title')
    
    </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('layouts.frontend.css-links')


</head>

<body>
@include('layouts.frontend.header')


@yield('page-content')




@include('layouts.frontend.footer')

@include('layouts.frontend.js-links')



</body>

</html>