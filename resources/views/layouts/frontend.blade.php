<!doctype html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CameraStore</title>
  <link rel="icon" href="{{asset('public/frontend/img/come (1).png')}}">
  <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
  <!-- animate CSS -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/frontend/css/lightslider.min.css')}}">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/all.css')}}">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('public/frontend/css/themify-icons.css')}}">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">
  <!-- style CSS -->
  <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
  <link rel="icon" href="img/favicon.png">
  <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}">

  <link rel="stylesheet" href="{{asset('public/frontend/css/slick.css')}}">
  <link rel="stylesheet" href="{{asset('public/frontend/css/price_rangs.css')}}">


</head>

<body>
   <!--::header part start::-->
    <header class="main_menu home_menu">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-12">
                  <nav class="navbar navbar-expand-lg navbar-light">
                      <a class="navbar-brand" href="{{route('frontend')}}"> <img src="{{asset('public/frontend/img/Coffee Please (3).png')}}" alt="logo"> </a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-expanded="false" aria-label="Toggle navigation">
                          <span class="menu_icon"><i class="fas fa-bars"></i></span>
                      </button>

                      <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                          <ul class="navbar-nav">
                              <li class="nav-item">
                                  <a class="nav-link" href="{{route('frontend.index')}}">S???n Ph???m</a>
                              </li>
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="{{route('frontend.thuonghieu',['all'])}}" id="navbarDropdown_1"
                                      role="button"  aria-haspopup="true" aria-expanded="false">
                                    Th????ng hi???u 
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                  @foreach($type as $value)
                                      <a class="dropdown-item" href="{{route('frontend.thuonghieu',['all' => $value->tenthuonghieu_slug])}}"> {{ $value->tenthuonghieu }}</a>
                                  
                                      @endforeach
                                  </div>
                              </li>
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="{{route('frontend.loai',['all'])}}" id="navbarDropdown_3"
                                      role="button"  aria-haspopup="true" aria-expanded="false">
                                      Lo???i Camrea
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                          @foreach($loai as $value)
                                              <a class="dropdown-item" href="{{route('frontend.loai',['all' => $value->tenloai_slug])}}"> {{ $value->tenloai }}</a>
                                              @endforeach    
                                      
                                  </div>
                              </li>
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="{{route('frontend.dungluong',['all'])}}" id="navbarDropdown_3"
                                      role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Dung l?????ng
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                          @foreach($dungluong as $value)
                                              <a class="dropdown-item" href="{{route('frontend.dungluong',['all' => $value->tendungluong])}}"> {{ $value->tendungluong }} GB</a>
                                          @endforeach    
                                      
                                  </div>
                              </li>
                              <li class="nav-item dropdown">
                          
                              
                              <li class="nav-item">
                                  <a class="nav-link" href="{{route('frontend.baiviet')}}">Tin T???c</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{route('frontend.lienhe')}}">Li??n H???</a>
                              </li>
                          </ul>
                      </div>
                      <div class="hearer_icon d-flex">
                          <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                          <!-- @if (Auth::check())<a href="{{route('khachhang.danhsachsanpham')}}"> <i class="ti-heart"></i> <sup class="badge rounded-circle bg-white">@if(!empty($sanphamyeuthich)){{ $sanphamyeuthich->count()  }} @endif  <sup></a>@endif -->
                            @if (!isset( Auth::user()->name))
                                <a href="{{route('khachhang.dangnhap')}}"><i class="ti-user"></i></a>
                              @else          
                                <a href="{{route('khachhang')}}"><i class="ti-user"></i></a>
                            @endif
                              <a href="{{route('frontend.giohang')}}">
                                  <i class="fas fa-cart-plus"></i><sup class="badge rounded-circle bg-white">{{ Cart::count() ?? 0 }}</sup>
                              </a>
                              <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <div class="single_product">

                                  </div>
                              </div> -->
                      </div>
                  </nav>
              </div>
          </div>
      </div>
      <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner" action="{{route('frontend.search')}}" method="get">
                    <input type="text" class="form-control" name="key" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    @yield('content')
  <!--::footer_part start::-->
  <footer class="footer_part">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-sm-6 col-lg-2">
          <div class="single_footer_part">
            <h4>S???n ph???m h??ng ?????u</h4>
            <ul class="list-unstyled">
              <li><a href="">Trang web ???????c qu???n l??</a></li>
              <li><a href="">Qu???n l?? danh ti???ng</a></li>
              <li><a href="">D???ng c??? ??i???n</a></li>
              <li><a href="">D???ch v??? Ti???p th???</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-lg-2">
          <div class="single_footer_part">
            <h4>???????ng d???n nhanh</h4>
            <ul class="list-unstyled">
              <li><a href="">Vi???c l??m</a></li>
              <li><a href="">T??i s???n th????ng hi???u</a></li>
              <li><a href="">Quan h??? ?????u t??</a></li>
              <li><a href="">??i???u kho???n d???ch v???</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-lg-2">
          <div class="single_footer_part">
            <h4>?????c tr??ng website</h4>
            <ul class="list-unstyled">
              <li><a href="">Vi???c l??m</a></li>
              <li><a href="">T??i s???n th????ng hi???u</a></li>
              <li><a href="">Quan h??? ?????u t??</a></li>
              <li><a href="">??i???u kho???n d???ch v???</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-lg-2">
          <div class="single_footer_part">
            <h4>T??i nguy??n website</h4>
            <ul class="list-unstyled">
              <li><a href="">H?????ng d???n</a></li>
              <li><a href="">T??m ki???m</a></li>
              <li><a href="">C??c chuy??n gia</a></li>
              <li><a href="">C?? quan</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="single_footer_part">
            <h4>Kh??c</h4>
            <p>Cung c???p ?? ki???n
            </p>
            <div id="mc_embed_signup">
              <form target="_blank"
                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get" class="subscribe_form relative mail_part">
                <input type="email" name="email" id="newsletter-form-email" placeholder="?????a ch??? email"
                  class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                  onblur="this.placeholder = ' Email Address '">
                <button type="submit" name="submit" id="newsletter-submit"
                  class="email_icon newsletter-submit button-contactForm">Chia s???</button>
                <div class="mt-10 info"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright_part">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="copyright_text">
              <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script>T???t c??? c??c quy???n | M???u n??y ???????c l??m b???ng <i class="ti-heart" aria-hidden="true"></i> b???i <a href="https://colorlib.com" target="_blank">Cao Trung T??nh</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="footer_icon social_icon">
              <ul class="list-unstyled">
                <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--::footer_part end::-->
  <div class="zalo-chat-widget" data-oaid="4167170574498929456" data-welcome-message="R???t vui khi ???????c h??? tr??? b???n!" data-autopopup="0" data-width="" data-height=""></div>

  <script src="https://sp.zalo.me/plugins/sdk.js"></script>
  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="{{asset('public/frontend/js/jquery-1.12.1.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/popper.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.magnific-popup.js')}}"></script>
  <script src="{{asset('public/frontend/js/lightslider.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/masonry.pkgd.js')}}"></script>
  <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/swiper.jquery.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.counterup.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/waypoints.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/contact.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.form.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/mail-script.js')}}"></script>
  <script src="{{asset('public/frontend/js/stellar.js')}}"></script>
  <script src="{{asset('public/frontend/js/theme.js')}}"></script>
  <script src="{{asset('public/frontend/js/custom.js')}}"></script>
  <script src="{{asset('public/frontend/js/lightslider.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/swiper.jquery.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.counterup.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/waypoints.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/contact.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.form.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/mail-script.js')}}"></script>
  <script src="{{asset('public/frontend/js/stellar.js')}}"></script>
  <script src="{{asset('public/frontend/js/theme.js')}}"></script>
  <script src="{{asset('public/frontend/js/custom.js')}}"></script>
 
  <script src="{{asset('public/frontend/js/swiper.min.js')}}"></script>


  <script src="{{asset('public/frontend/js/price_rangs.js')}}"></script>
  @yield('javascript')

</body>

</html>