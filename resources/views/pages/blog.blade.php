<!doctype html>
<html lang="en">

  <head>
    <title> N-Media Blog </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('blog/fonts/icomoon/style.css') }} ">

    <link rel="stylesheet" href="{{ asset('blog/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('blog/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="{{ asset('blog/css/jquery.fancybox.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('blog/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('blog/css/owl.theme.default.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('blog/fonts/flaticon/font/flaticon.css') }} ">
    <link rel="stylesheet" href="{{ asset('blog/css/aos.css') }} ">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('blog/css/style.css') }} ">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3 ">
              <div class="site-logo">
                <a href="/" class="font-weight-bold"> N-Media.</a>
              </div>
            </div>

            <div class="col-9  text-right">
             <span class="d-inline-block d-lg-block"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>
              <nav class="site-navigation text-right ml-auto d-none d-lg-none" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li><a href="/" class="nav-link">Home</a></li>
                  <li><a href="/aboutus.php" class="nav-link">About Us</a></li>
                  <li><a href="/ourservices.php" class="nav-link">Services</a></li>
                  <li class="active"><a href="#" class="nav-link">Blog</a></li>
                  <li><a href="/ourcontact.php" class="nav-link">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>

      </header>


      <div class="ftco-blocks-cover-1">
        <div class="site-section-cover overlay" style="background-image: url('{{ asset('blog/images/hero_1.jpg') }} ');">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7 text-center">
                <h1 class="text-white">Blog Posts</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="site-section bg-light">
        @if(!empty($blogs) && $blogs->count())  
          <div class="container">
            <div class="row">
                  @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="post-entry-1 h-100">
                          <a href="/blogs/{{$blog->id}}">
                              <img src="{{ asset ($blog->imgBlog) }} " alt="Image"
                              class="img-fluid">
                          </a>
                          <div class="post-entry-1-contents">       
                              <h2><a href="/blogs/{{$blog->id}}"> {{ $blog->title }}</a></h2>
                              <span class="meta d-inline-block">{{ date('Y-m-d', strtotime ($blog->created_at)) }} <span class="mx-2">by</span> <a href="#">Admin</a></span>
                              <p style = "color:black;"> {!! Str::limit($blog->contents, 220) !!}</p>
                          </div>
                        </div>
                    </div>
                  @endforeach
            </div>
              {!! $blogs->links() !!}
              
              <div class="col-12 mt-5 text-center">
                <!-- <span class="p-3">1</span> -->
                <!-- <a href="#" class="p-3">2</a>
                <a href="#" class="p-3">3</a>
                <a href="#" class="p-3">4</a> -->
              </div>
        @else
            <div class="row">
              <div style = "color:black;">      
                <h2 style ="text-align:center;"> THERE ARE NO BLOG POSTS YET </a></h2> 
              </div>  
            </div>
        @endif 

          </div>
       
      </div> 
     <!-- END .site-section -->
    

      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="footer-heading mb-2">About Me</h2>
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
            </div>
            <div class="col-lg-8 ml-auto">
              <div class="row">
                <div class="col-lg-6 ml-auto">
                  <h2 class="footer-heading mb-2">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <h2 class="footer-heading mb-2">Connect</h2>
                  <div class="social_29128 white mb-5">
                    <a href="#"><span class="icon-facebook"></span></a>  
                    <a href="#"><span class="icon-instagram"></span></a>  
                    <a href="#"><span class="icon-twitter"></span></a>  
                  </div>
                  <h2 class="footer-heading mb-4">Newsletter</h2>
                  <form action="#" class="d-flex" class="subscribe">
                    <input type="text" class="form-control mr-3" placeholder="Email">
                    <input type="submit" value="Send" class="btn btn-primary">
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top">
                <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved              </p>
              </div>
            </div>

          </div>
        </div>
      </footer>

    </div>

    <script src="{{ asset('blog/js/jquery-3.3.1.min.js') }} "></script>
    <script src="{{ asset('blog/js/jquery-migrate-3.0.0.js') }} "></script>
    <script src="{{ asset('blog/js/popper.min.js') }} "></script>
    <script src="{{ asset('blog/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('blog/js/owl.carousel.min.js') }} "></script>
    <script src="{{ asset('blog/js/jquery.sticky.js') }} "></script>
    <script src="{{ asset('blog/js/jquery.waypoints.min.js') }} "></script>
    <script src="{{ asset('blog/js/jquery.animateNumber.min.js') }} "></script>
    <script src="{{ asset('blog/js/jquery.fancybox.min.js') }} "></script>
    <script src="{{ asset('blog/js/jquery.stellar.min.js') }} "></script>
    <script src="{{ asset('blog/js/jquery.easing.1.3.js') }} "></script>
    <script src="{{ asset('blog/js/bootstrap-datepicker.min.js') }} "></script>
    <script src="{{ asset('blog/js/isotope.pkgd.min.js') }} "></script>
    <script src="{{ asset('blog/js/aos.js') }} "></script>

    <script src="{{ asset('blog/js/main.js') }} "></script>

  </body>

</html>

