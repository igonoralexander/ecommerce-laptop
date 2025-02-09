<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

  <head>
  <title> N-Media Studio | Photo Gallery </title>
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="n-mediastudio.com, Igonor Nathaniel, Photography, Gallery, How to buy Giftcards, Mobile Application">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300i,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('photo/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{ asset('photo/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('photo/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('photo/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('photo/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('photo/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{ asset('photo/css/lightgallery.min.css')}}">    
    
    <link rel="stylesheet" href="{{ asset('photo/css/bootstrap-datepicker.css')}}">

    <link rel="stylesheet" href="{{ asset('photo/fonts/flaticon/font/flaticon.css')}}">
    
    <link rel="stylesheet" href="{{ asset('photo/css/swiper.css')}}">

    <link rel="stylesheet" href="{{ asset('photo/css/aos.css')}}">

    <link rel="stylesheet" href="{{ asset('photo/css/style.css')}}">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar py-3 border-bottom" role="banner">

      <div class="container-fluid">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2" data-aos="fade-down">
            <h4>
                <a href="/" class="text-black h5"> N-Media Studio <br> (Genuis Photography)</a>
            </h4>
          </div>
          <div class="col-10 col-md-8 d-none d-xl-block" data-aos="fade-down">
            <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">

              <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                <li><a href="/">Home</a></li>

             <li class="has-children">
                  <a href="">Photo Gallery</a>
                  <ul class="dropdown">
                  @foreach($category as $cate)
                    <li><a href="{{ route ('photo-gallery', $cate->id) }}">{{$cate->name}}</a></li>
                  @endforeach
                  </ul>
                </li>

                <li class="has-children">
                  <a href="">Video Gallery</a>
                  <ul class="dropdown">
                  @foreach($category as $cate)
                    <li><a href="{{ route ('video-gallery', $cate->id) }}">{{$cate->name}}</a></li>
                  @endforeach
                  </ul>
                </li>

                
                <li class="has-children">
                  <a href="#">Pages</a>
                  <ul class="dropdown">
                    <li><a href="/ourservices.php">Services</a></li>
                    <li><a href="/aboutus.php">About</a></li>
                    <li><a href="/ourcontact.php">Contact</a></li>
                    <!-- <li><a href="/testimonial.php">Testimonial</a></li> -->
                    <li><a href="/blog.php">Blog</a></li>
                  </ul>
                </li>
              
              </ul>
            </nav>
          </div>

          <div class="col-6 col-xl-2 text-right" data-aos="fade-down">
            <div class="d-none d-xl-inline-block">
              <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
                <li>
                  <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                </li>
                <li>
                  <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                </li>
                <li>
                  <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                </li>
                <li>
                  <a href="#" class="pl-3 pr-3"><span class="icon-youtube-play"></span></a>
                </li>
              </ul>
            </div>

            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
    </header>

    <div class="site-section"  data-aos="fade">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-7">
              <div class="row mb-5">
                <div class="col-12 ">
                  <h2 class="site-section-heading text-center"> {{$category1->name}} Gallery</h2>
                </div>
              </div>
            </div>
          </div>

          @if(!empty($images) && $images->count())
            <div class="row" id="lightgallery">    
                @foreach($images as $photo)
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 item" data-aos="fade" data-src="{{ asset ($photo->image) }}">
                  <a href="#"><img src= " {{ asset ($photo->image) }} " alt="" class="img-fluid"></a>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="container-fluid">
            <div style = "color:black; " >
              <h3 style = "text-align:center;"> THERE IS NOTHING TO SHOW YET </h3>   
            </div>
        </div>
        @endif
    </div>
      <div class="footer py-4">
        <div class="container-fluid">
        <p>
             &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> Made by <a href="https://igsoftware.com.ng" target="_blank" >IG Software Nig</a>
        </p>
        </div>
      </div>

  </div>

      <script src="{{ asset('photo/js/jquery-3.3.1.min.js')}}"></script>
      <script src="{{ asset('photo/js/jquery-migrate-3.0.1.min.js')}}"></script>
      <script src="{{ asset('photo/js/jquery-ui.js')}}"></script>
      <script src="{{ asset('photo/js/popper.min.js')}}"></script>
      <script src="{{ asset('photo/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('photo/js/owl.carousel.min.js')}}"></script>
      <script src="{{ asset('photo/js/jquery.stellar.min.js')}}"></script>
      <script src="{{ asset('photo/js/jquery.countdown.min.js')}}"></script>
      <script src="{{ asset('photo/js/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{ asset('photo/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{ asset('photo/js/swiper.min.js')}}"></script>
      <script src="{{ asset('photo/js/aos.js')}}"></script>

      <script src="{{ asset('photo/js/picturefill.min.js')}}"></script>
      <script src="{{ asset('photo/js/lightgallery-all.min.js')}}"></script>
      <script src="{{ asset('photo/js/jquery.mousewheel.min.js')}}"></script>
      <script src="{{ asset('photo/js/main.js')}}"></script>
  
    <script>
      $(document).ready(function(){
        $('#lightgallery').lightGallery();
      });
    </script>
      
  </body>
</html>