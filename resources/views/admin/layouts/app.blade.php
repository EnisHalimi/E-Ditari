<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        function markAsRead(id)
        {
            $.ajax({
            type:'POST',
            url:'/admin/markAsRead',
            data:{
            "_token": "{{ csrf_token() }}",
            "id":id
            },
            success:function(data)
            {
                $('#not'+id+' #notifications span').text('U markua si e lexuar');
                $('#not'+id+' #notifications span').addClass('text-success');
                $('#not-number').text($('#not-number').text() - 1 );
                if($('#not-number').text() == 0)
                    $('#not-number').hide();
                setTimeout(function(){
                $('#not'+id).remove();
                }, 1000);
            }
            });
        }

    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8a31e3561e.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app-admin.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="{{route('admin.home')}}"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-lightbulb"></i>
          </div>
          <div class="sidebar-brand-text mx-3">E-Ditari</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item  @yield('dashboard') ">
          <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Ballina</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">
          E-Ditari
        </div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item @yield('classroom')">
        <a class="nav-link" href="{{route('admin.classroom.index')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Klasët</span></a
        >
      </li>

      <li class="nav-item @yield('schedule')">
      <a class="nav-link" href="{{route('admin.schedule.index')}}">
          <i class="fas fa-calendar-alt"></i>
          <span>Orari</span></a
        >
      </li>

      <li class="nav-item @yield('subject')">
        <a class="nav-link" href="{{route('admin.subject.index')}}">
            <i class="fas fa-book"></i>
            <span>Lëndët</span></a
          >
        </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">
        Te tjera
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item @yield('school')">
        <a class="nav-link" href="{{route('admin.school.index')}}">
          <i class="fas fa-school"></i>
          <span>Shkollat</span></a
        >
      </li>

      <li class="nav-item @yield('admin')">
        <a class="nav-link" href="{{route('admin.admin.index')}}">
          <i class="fas fa-chalkboard-teacher"></i>
          <span>Mesimdhenesit</span></a
        >
      </li>

      <li class="nav-item @yield('role')">
        <a class="nav-link" href="{{route('admin.role.index')}}">
          <i class="fas fa-user-tag"></i>
          <span>Rolet</span></a
        >
      </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <!-- Sidebar Toggle (Topbar) -->
            <button
              id="sidebarToggleTop"
              class="btn btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="searchDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown"
                >
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control bg-light border-0 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="alertsDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                @if(Auth()->user()->notifications_count != 0)
                <span id="not-number" class="badge badge-danger badge-counter">{{Auth()->user()->notifications_count}}</span>
                @endif
                </a>
                <!-- Dropdown - Alerts -->
                <div
                  class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="alertsDropdown"
                >
                  <h6 class="dropdown-header">
                    Alerts Center
                  </h6>
                  <ul id="notifications-list" class="list-group">
                    @if(Auth()->user()->notifications_count == 0)
                    <li class="list-group-item p-0">
                    <div class="dropdown-item d-flex align-items-center" >
                        <div id="notifications">
                          <span class="font-weight-bold">Nuk ka njoftime!</span>
                        </div>

                      </div>
                    </li>
                    @else

                    @foreach(Auth()->user()->notifications as $not)
                  <li id="not{{$not->id}}" class="list-group-item p-0">
                    <div class="dropdown-item d-flex align-items-center px-0" >
                      <div class="mx-3">
                        <div class="icon-circle bg-primary">
                          <i class="fas fa-bell text-white"></i>
                        </div>
                      </div>
                      <div id="notifications">
                        <div class="small text-gray-500">{{$not->created_at}}</div>
                        <span class="font-weight-bold">{{$not->description}}!</span>
                      </div>
                      <div class="ml-auto mr-3">
                          <a class="close" href="#" id="deleteNotification" onclick ="markAsRead({{$not->id}})" >
                              <span>&times;</span>
                          </a>
                      </div>
                    </div>
                  </li>
                    @endforeach

                    </ul>
                    @endif
                  <a
                    class="dropdown-item text-center small text-gray-500"
                    href="#"
                    >Show All Alerts</a
                  >
                </div>
              </li>

              <!-- Nav Item - Messages -->

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                    >{{Auth::user()->full_name}}</span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="{{asset('img/'.Auth::user()->photo)}}"
                  />
                </a>
                <!-- Dropdown - User Information -->
                <div
                  class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown"
                >
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="{{route('admin.logs')}}">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#logoutModal"
                  >
                    <i
                      class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            @if(session('success'))
            <div class="alert  bg-white  ml-auto mr-auto border-left-success" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="alert  bg-white   ml-auto mr-auto border-left-danger" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
           @yield('content')
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; E-Ditari 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">Logout</a>
            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
  </body>
</html>
