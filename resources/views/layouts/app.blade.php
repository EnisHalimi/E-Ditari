<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel')  }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8a31e3561e.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    @if(Request::url() === route('login'))
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif

</head>
<body>
    @Auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="ml-5 mr-4 logo">
            <a href="{{route('home')}}"><img class="logo-img" src="img/Logo.png" /></a>
        </div>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item mr-3">
                <a class="nav-link @yield('profile')" href="{{route('home')}}">Profili</a>
              </li>
              <li class="nav-item mr-3">
                <a class="nav-link @yield('moodle')" href="{{route('moodle')}}">Ditari</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @yield('calendar')" href="{{route('calendar')}}">Kalendari</a>
              </li>
            </ul>
            <ul class="navbar-nav mr-5">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <img
                    class="nav-item nav-profile-pic"
                    src="{{asset('img/'.Auth::user()->photo)}}"
                    alt="Profile Picture"
                  />
                  {{Auth::user()->full_name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item"  onclick="event.preventDefault();document.querySelector('#logout-form').submit();" href="#"
                    >Log Out
                    <svg
                      width="1em"
                      height="1em"
                      viewBox="0 0 16 16"
                      class="bi bi-box-arrow-right"
                      fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M11.646 11.354a.5.5 0 0 1 0-.708L14.293 8l-2.647-2.646a.5.5 0 0 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M4.5 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M2 13.5A1.5 1.5 0 0 1 .5 12V4A1.5 1.5 0 0 1 2 2.5h7A1.5 1.5 0 0 1 10.5 4v1.5a.5.5 0 0 1-1 0V4a.5.5 0 0 0-.5-.5H2a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-1.5a.5.5 0 0 1 1 0V12A1.5 1.5 0 0 1 9 13.5H2z"
                      /></svg
                  ></a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>


                </div>
              </li>
            </ul>
          </div>
        </nav>

        <div class="container pt-3 mt-4 mb-4 shadow bg-white">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')
        </div>
        @endauth
        @yield('login-content')

        <script src="{{ asset('js/app.js') }}" defer></script>


</body>
</html>
