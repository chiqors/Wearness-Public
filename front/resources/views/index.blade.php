@php
    use App\AppSetting;
    $app = AppSetting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    {{ $app->name.' - '. $app->tagline}}
  </title>  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="/admin/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/admin/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="/admin/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
  @yield('style')
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./index.html">
        <img src="{{ $dev->url.'/'.$app->logo }}" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        {{-- <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                @if (Auth::user()->customer->photo == null)
                  <img alt="Image placeholder" src="{{ $dev->url.'/image/asset/default-user.png' }}">                    
                @else
                  @if (Auth::user()->customer->added == "register")
                    <img alt="Image placeholder" src="{{ '/image/asset/customer/'.Auth::user()->customer->photo }}" style="height:100% !important">          
                  @else
                    <img alt="Image placeholder" src="{{ $dev->url.'/image/asset/customer'.Auth::user()->customer->photo }}">
                  @endif
                @endif
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="{{ url('/student/setting') }}" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>          
            <div class="dropdown-divider"></div>
            
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ url('/') }}">
                <img src="{{ $dev->url.'/'.$app->logo }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>        
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item {{ Request::is('student') ? 'active' : false}}">
          <a class=" nav-link {{ Request::is('student') ? 'active' : false}} " href="{{ url('/student') }}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item {{ Request::is('student/curiculum') ? 'active' : false}}">
            <a class="nav-link {{ Request::is('student/curiculum') ? 'active' : false}}" href="{{ url('/student/curiculum') }}">
              <i class="ni ni-planet text-blue"></i> Curiculum
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('student/modul') ? 'active' : false}}" href="{{ url('/student/modul') }}">
              <i class="ni ni-atom text-orange"></i> Modul
            </a>
          </li>        
          <li class="nav-item {{ Request::is('student/project*') ? 'active' : false}}">
            <a class="nav-link {{ Request::is('student/project*') ? 'active' : false}}" href="{{ url('/student/project') }}">
              <i class="ni ni-bullet-list-67 text-red"></i> Project
            </a>
          </li>          
          <li class="nav-item {{ Request::is('student/feedback') ? 'active' : false}}">
            <a class="nav-link {{ Request::is('student/feedback') ? 'active' : false}}" href="{{ url('/student/feedback') }}">
              <i class="ni ni-curved-next text-green"></i> Feedback
            </a>
          </li>          
        </ul>        
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        @yield('brand')
        <!-- Form -->        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">            
            {{-- <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-bell-55"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1" style="right: 190px;">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div> --}}
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  @if (Auth::user()->customer->photo == null)
                    <img alt="Image placeholder" src="{{ $dev->url.'/image/asset/default-user.png' }}">                    
                  @else
                    @if (Auth::user()->customer->added == "register")
                      <img alt="Image placeholder" src="{{ '/image/asset/customer/'.Auth::user()->customer->photo }}" style="height:100% !important">          
                    @else
                      <img alt="Image placeholder" src="{{ $dev->url.'/image/asset/customer'.Auth::user()->customer->photo }}">
                    @endif
                  @endif
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="{{ url('/student/setting') }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>                           
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form2').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>          
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->          
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">     
     @yield('content')
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 {{ $app->name }}
            </div>
          </div>        
        </div>
      </footer>
    </div>
  </div>
  @stack('script')
</body>

</html>