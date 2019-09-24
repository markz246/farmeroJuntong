<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Farmero &mdash; @yield('title','Home')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/matrix.formvalidation.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
</head>
<body>
    <div id="app">
        <nav class="site-navbar-top navbar-expand-sm navbar-light bg-light ">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="/orders"> View Orders</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <header class="site-navbar">
            <nav class="site-nav-wrap navbar-expand-sm navbar-light bg-white ">
                <div class="container">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <a class="navbar-brand" href="/home">
                                <img src="/images/farmeroS.png" alt="farmeroLogo" style="height: 75px;">
                            </a>
                        </ul>
                        <ul class="navbar-nav mr-auto col-6 col-md-4 site-search-icon">
                            <input type="text" class="form-control bg-light" placeholder="Search">
                        </ul>
                        <div class="site-top-icons">
                            <?php 
                                use App\Products;
                                $cartCount = Products::cartCount();
                            ?>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link site-cart" href="/shop/cart">
                                <span class="fa fa-shopping-cart fa-2x" style="color: #f78914"></span>
                                @guest

                                @else
                                    <span class="count">{{$cartCount}}</span>
                                @endguest
                                </a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        
        <nav class="site-nav-wrap navbar-expand-sm navbar-light bg-white">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!--<ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href=""></a>
                                </div>
                        </li>
                    </ul>-->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/shop">
                                Shop
                            </a>
                        </li>
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item site-top-icons">
                                <?php 
                                    use App\Order;
                                    $orderCount = Order::orderCount();
                                ?>
                                <a class="nav-link site-cart" href="/orders">
                                    View Orders
                                    @guest

                                    @else
                                        <span style="color:orange;">({{$orderCount}})</span>
                                    @endguest
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
