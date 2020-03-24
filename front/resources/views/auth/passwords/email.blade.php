@php
    use App\DevTable;
    use App\AppSetting;
    $dev = DevTable::first();          
    $app = AppSetting::first();          
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    {{ $app->name }} - {{ $app->tagline }}
  </title>  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="/admin/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="/admin/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="/admin/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
        <div class="container px-4">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ $dev->url.'/'.$app->logo }}" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
              <div class="row">
                <div class="col-6 collapse-brand">
                  <a href="../index.html">
                    <img src="/admin/assets/img/brand/blue.png">
                  </a>
                </div>
                <div class="col-6 collapse-close">
                  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                    <span></span>
                    <span></span>
                  </button>
                </div>
              </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">            
              <li class="nav-item">
                <a class="nav-link nav-link-icon" href="{{ url('/register') }}">
                  <i class="ni ni-circle-08"></i>
                  <span class="nav-link-inner--text">Register</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-link-icon" href="{{ url('/login') }}">
                  <i class="ni ni-key-25"></i>
                  <span class="nav-link-inner--text">Login</span>
                </a>
              </li>            
            </ul>
          </div>
        </div>
      </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">
                {{ $app->name }}
              </h1>
              <p class="text-lead text-light">{{ $app->tagline }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">            
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Reset </small>
              </div>
              <form method="POST" action="{{ route('reset') }}">                        
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email" required>
                  </div>
                </div>                             
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Send passwod reset link</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ url('/login') }}" class="text-light"><small>Login</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{ url('/register') }}" class="text-light"><small>Create new account</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="py-5">
        <div class="container">
          <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
              <div class="copyright text-center text-xl-left text-muted">
                &copy; 2019 <a class="font-weight-bold ml-1" target="_blank">{{ $app->name }}</a>
              </div>
            </div>
            {{-- <div class="col-xl-6">
              <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                <li class="nav-item">
                  <a href="https://www.makerindo.com" class="nav-link" target="_blank">MakerIndo</a>
                </li>            
              </ul>
            </div> --}}
          </div>
        </div>
      </footer>
  </div>

 
  <!--   Core   -->
  <script src="/admin/assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="/admin/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="/admin/assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>

   
@if (session()->has('success'))
<div class="modal fade show" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div  class="modal-content bg-success text-white border-0">
        <div class="modal-header border-bottom-0">
            <h5 class="modal-title">Success</h5>              
        </div>
        <div class="modal-body">
            <h5>{{ session()->get('success') }}</h5>
        </div>
        <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <script>
    $('#successModal').modal('show')
    </script>
@endif

@if (session()->has('warning'))
<div class="modal fade show" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div  class="modal-content bg-warning text-white border-0">
        <div class="modal-header border-bottom-0">
            <h5 class="modal-title">Warnig</h5>              
        </div>
        <div class="modal-body">
            <h5>{{ session()->get('warning') }}</h5>
        </div>
        <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <script>
    $('#successModal').modal('show')
    </script>
@endif

@if (session()->has('errorss'))
<div class="modal fade show" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div  class="modal-content bg-danger text-white border-0">
        <div class="modal-header border-bottom-0">
            <h5 class="modal-title">Ops</h5>              
        </div>
        <div class="modal-body">
            <h5>{{ session()->get('errorss') }}</h5>
        </div>
        <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <script>
    $('#successModal').modal('show')
    </script>
@endif
</body>

</html>