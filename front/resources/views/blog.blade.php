<!DOCTYPE html>
<html lang="en">
  <head>
      <title>{{ $app->name }} &mdash; {{ $app->tagline }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <!-- <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet"> -->
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/asset/css/jquery-ui.css">
    <link rel="stylesheet" href="/asset/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/asset/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/asset/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="/asset/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="/asset/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="/asset/css/aos.css">

    <link rel="stylesheet" href="/asset/css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
            <div class="site-logo mr-auto w-25">
                <a href="{{ url('/') }}">
                  <img src="{{ $dev->url.'/'.$app->logo }}" alt="" srcset="" width="100%">
                </a>
              </div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#courses-section" class="nav-link">Courses</a></li>                
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="intro-section single-cover" id="home-section" style="height: 100px !important;">
      
      <div class="slide-1 " style="background-image: url('/asset/images/img_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row justify-content-center align-items-center text-center">              

                
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-5">

            @isset($blogDetail)                
            <div class="mb-5">
              <h3 class="text-black">{{ $blogDetail->title }}</h3>      
              <p class="mb-4">
                  <strong class="text-black mr-3">{{ $blogDetail->user->name }}</strong> {{ $blogDetail->created_at->format('D d M y') }}
                </p>        
              {!! $blogDetail->content !!}
            </div>
            @else
            <div class="card">
              <div class="card-title">
                <h1> 404 blog tidak ditemukan</h1>
              </div>
            </div>
            @endisset
                
        </div>
      </div>
    </div>

    <div class="site-section courses-title bg-dark" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">More Blog</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section courses-entry-wrap"  data-aos="fade" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

              @foreach ($blog as $key => $value)                
              <div class="course bg-white h-100 align-self-stretch">
                <figure class="m-0">
                  <a href="{{ url('/blog/'.$value->id) }}"><img src="{{ $dev->url.'/'.$value->cover }}" alt="Image" class="img-fluid"></a>
                </figure>
                <div class="course-inner-text py-4 px-4">
                  {{-- <span class="course-price">$99</span> --}}
                  {{-- <div class="meta"><span class="icon-clock-o"></span>4 Lessons / 12 week</div> --}}
                  <h3><a href="#">{{ $value->title }}</a></h3>
                  {{-- <p>Lorem ipsum dolor sit amet ipsa nulla adipisicing elit. </p> --}}
                </div>
                <div class="d-flex border-top stats">
                  <div class="py-3 px-4"><span class="icon-users"></span> {{  $value->user->name }}</div>
                  <div class="py-3 px-4 ml-auto border-left"><span class="icon-chat"></span>{{ $value->created_at->format('D d M y') }}</div>
                </div>
              </div>
              @endforeach

          </div>

         

        </div>
        <div class="row justify-content-center">
          <div class="col-7 text-center">
            <button class="customPrevBtn btn btn-primary m-1">Prev</button>
            <button class="customNextBtn btn btn-primary m-1">Next</button>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
        <div class="container">
  
          <div class="row justify-content-center">
            <div class="col-md-7">
  
  
              
              <h2 class="section-title mb-3">Message Us</h2>
              {{-- <p class="mb-5">Natus totam voluptatibus animi aspernatur ducimus quas obcaecati mollitia quibusdam temporibus culpa dolore molestias blanditiis consequuntur sunt nisi.</p> --}}
            
              <div class="row">
                <div class="col-md-6">
                  <p>
                    Phone number : {{ $contact->phone_number }}
                  </p>
                </div>
                <div class="col-md-6">
                  <p>
                    Email : {{ $contact->email }}
                  </p>
                </div>
                <div class="col-md-4">
                  <a href="{{ $contact->facebook }}">
                    Facebook
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="{{ $contact->instagram }}">
                    Instagram
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="{{ $contact->twitter }}">
                    Twitter
                  </a>
                </div>
                <div class="col-md-12 mt-3">
                  <p>
                      {{ $contact->location }}
                  </p>
                </div>              
              </div>
            </div>
          </div>
        </div>
      </div>
     
    <footer class="bg-white">
        <div class="container">
          {{-- <div class="row">
            <div class="col-md-4">
              <h3>About OneSchool</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro consectetur ut hic ipsum et veritatis corrupti. Itaque eius soluta optio dolorum temporibus in, atque, quos fugit sunt sit quaerat dicta.</p>
            </div>
  
            <div class="col-md-3 ml-auto">
              <h3>Links</h3>
              <ul class="list-unstyled footer-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Programs</a></li>
                <li><a href="#">Teachers</a></li>
              </ul>
            </div>
  
            <div class="col-md-4">
              <h3>Subscribe</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt incidunt iure iusto architecto? Numquam, natus?</p>
              <form action="#" class="footer-subscribe">
                <div class="d-flex mb-5">
                  <input type="text" class="form-control rounded-0" placeholder="Email">
                  <input type="submit" class="btn btn-primary rounded-0" value="Subscribe">
                </div>
              </form>
            </div>
  
          </div> --}}
  
          <div class="row pt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
              <p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy; {{ $app->name }} <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
              </div>
            </div>
            
          </div>
        </div>
      </footer>

  
    
  </div> <!-- .site-wrap -->

  <script src="/asset/js/jquery-3.3.1.min.js"></script>
  <script src="/asset/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/asset/js/jquery-ui.js"></script>
  <script src="/asset/js/popper.min.js"></script>
  <script src="/asset/js/bootstrap.min.js"></script>
  <script src="/asset/js/owl.carousel.min.js"></script>
  <script src="/asset/js/jquery.stellar.min.js"></script>
  <script src="/asset/js/jquery.countdown.min.js"></script>
  <script src="/asset/js/bootstrap-datepicker.min.js"></script>
  <script src="/asset/js/jquery.easing.1.3.js"></script>
  <script src="/asset/js/aos.js"></script>
  <script src="/asset/js/jquery.fancybox.min.js"></script>
  <script src="/asset/js/jquery.sticky.js"></script>

  
  <script src="/asset/js/main.js"></script>
  <script>
      $(document).ready(function () {
          $.each($('[data-filename]'), (i, val) => {	
              let img = $(val).attr('src')
  let dev = '{{ $dev->url }}'
              if(img[0] !=  'h'){
                  $(val).attr('src' , dev+''+img)
              }
          })
      })
  </script>
  </body>
</html>