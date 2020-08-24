<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404 Not Found | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8a31e3561e.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app-admin.css') }}" rel="stylesheet">
</head>

<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="{{route('home')}}">&larr; Back to Dashboard</a>
          </div>

    </div>

  </div>

  <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>


