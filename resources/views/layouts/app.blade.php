<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'WEB-BLOG') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Styles -->
  <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
  <link rel="icon" href="{{asset('img/favicon.png')}}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dropdown.css') }}" rel="stylesheet">
  <link href="{{ asset('css/stylecustom.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'WEB-BLOG') }}
        </a>
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
                {{ Auth::user()->name }}
                [
                @if(Auth::user()->role == 'admin')
                  <i class="fa fa-vcard-o"></i> {{Auth::user()->role}}
                @elseif(Auth::user()->role == 'writer')
                  <i class="fa fa-user-plus"></i> {{Auth::user()->role}}
                @else
                  <i class="fa fa-user"></i> {{Auth::user()->role}}
                @endif
                ]
                <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{route('welcome')}}">{{ __('Home') }}</a>
                <a class="dropdown-item" href="{{ route('user.edit') }}">
                {{ __('Edit profile') }}
              </a>
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

  @auth
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item-cus">
            <a class="nav-link" href="{{ url('/home') }}">หน้าแรก <span class="sr-only">(current)</span></a>
          </li>
          @if(auth()->user()->checkStatus())
            <li class="nav-item-cus">
              <a class="nav-link" href="{{route('posts.index')}}">บทความ</a>
            </li>
            <li class="nav-item-cus">
              <a class="nav-link" href="{{route('categories.index')}}">ประเภทบทความ</a>
            </li>
            <li class="nav-item-cus">
              <a class="nav-link" href="{{route('tags.index')}}">แท็กบทความ</a>
            </li>
            @if(auth()->user()->isAdmin())
              <li class="nav-item-cus dropdown">
                <a class="nav-link dropbtn dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ตั้งค่าระบบ
                </a>
                <div class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">ข่าวสาร / ประกาศ</a>
                  <a class="dropdown-item" href="#">คู่มือการใช้งาน</a>
                </div>
              </li>
              <li class="nav-item-cus dropdown">
                <a class="nav-link dropbtn dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  จัดการผู้ใช้งาน
                </a>
                <div class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{route('users.status')}}">พิจารณาคำขอ</a>
                  <a class="dropdown-item" href="{{route('users.detail')}}">ผู้ใช้งาน</a>
                  <a class="dropdown-item" href="{{route('admin.index')}}">ผู้ดูแลระบบ</a>
                </div>
              </li>
            @else
              <li class="nav-item-cus">
                <a class="nav-link" href="#">คู่มือการใช้งาน</a>
              </li>
            @endif
          @endif
        </ul>
      </div>
    </div>
  </nav>
  @endauth
  <main class="py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          @if(Session()->has('success'))
          <div class="alert alert-success">
            {{Session()->get('success')}}
          </div>
          @endif
          @if(Session()->has('error'))
          <div class="alert alert-danger">
            {{Session()->get('error')}}
          </div>
          @endif
        </div>
      </div>
    </div>
    @yield('content')
  </main>
</div>
</body>
</html>
