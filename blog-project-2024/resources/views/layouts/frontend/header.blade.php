<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center">
            <h1>ZenBlog</h1>
        </a>

<<<<<<< Updated upstream
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html">Blog</a></li>
          <li><a href="{{route('frontend-single-post')}}">Single Post</a></li>
          <li class="dropdown"><a href="category.html"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
=======
        <nav id="navbar" class="navbar">
>>>>>>> Stashed changes
            <ul>
                <li><a href="{{ route('frontend-index') }}">Blog</a></li>
                <li><a href="{{ route('frontend-single-post') }}">Single Post</a></li>
                <li class="dropdown"><a href="{{ route('frontend-category') }}"><span>Categories</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="{{ route('frontend-search') }}">Search Result</a></li>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('frontend-about') }}">About</a></li>
                <li><a href="{{ route('frontend-contact') }}">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
            <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
            <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- Sign In and Sign Up -->
            <a href="{{ route('frontend-login') }}" class="mx-2">Sign In</a>
            <a href="{{ route('frontend-register') }}" class="mx-2">Sign Up</a>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- End Search Form -->

        </div>

    </div>

</header><!-- End Header -->
