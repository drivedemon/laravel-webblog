<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="keywords" content="">

  @yield('title')

  <link href="{{asset('css/page.css')}}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
  <link rel="icon" href="{{asset('img/favicon.png')}}">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
    <div class="container">

      <div class="navbar-left">
        <button class="navbar-toggler" type="button">&#9776;</button>
        <a class="navbar-brand" href="{{route('welcome')}}">
          <img class="logo-dark" src="{{asset('img/logo-dark.png')}}" alt="logo">
          <img class="logo-light" src="{{asset('img/logo-light.png')}}" alt="logo">
        </a>
      </div>
      @guest
        <a class="btn btn-xs btn-round btn-success" href="{{route('home')}}">Login</a>
      @else
        @if(auth()->user()->isAdmin() == 'admin' || auth()->user()->isAdmin() == 'writer' )
          <div class="dropdown">
            <button class="btn btn-xs btn-round btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{auth()->user()->name}}
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{route('home')}}">Homepage</a>
              <a class="dropdown-item" href="{{route('user.edit')}}">Edit profile</a>
              <a class="dropdown-item" href="{{route('logout')}}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        @else
            <a class="btn btn-xs btn-round btn-success" href="{{route('logout')}}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
        @endif
      @endguest
    </div>
  </nav>

  @yield('header')

  @yield('content')

  <script src="{{asset('js/page.js')}}"></script>
  <script src="{{asset('js/script.js')}}"></script>

</body>
</html>
