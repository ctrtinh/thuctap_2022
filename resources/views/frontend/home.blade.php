@extends('layouts.frontend')
@section('content')
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel">
                        <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>CCTV Camera   
                                               </h1>
                                            <p>Mua sắm là niềm vui. Shop luôn luôn cam kết uy tín sản phẩm đảm bảo chất lượng, chính hãng 100%!.</p>
                                            <a href="{{route('frontend.index')}}" class="btn_2">Mua Ngay</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img class="" src="{{asset('public/frontend/img/008 (1) (1).png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>CCTV Camera </h1>
                                            <p>Mua sắm là niềm vui. Shop luôn luôn cam kết uy tín sản phẩm đảm bảo chất lượng, chính hãng 100%!.</p>
                                                <a href="{{route('frontend.index')}}" class="btn_2">Mua Ngay</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                <img class="" src="{{asset('public/frontend/img/008 (1) (1).png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>CCTV Camera </h1>
                                            <p>Mua sắm là niềm vui. Shop luôn luôn cam kết uy tín sản phẩm đảm bảo chất lượng, chính hãng 100%!.</p>
                                                <a href="{{route('frontend.index')}}" class="btn_2">Mua Ngay</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                <img class="" src="{{asset('public/frontend/img/008 (1) (1).png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>Cloth $ Wood Sofa</h1>
                                            <p>Incididunt ut labore et dolore magna aliqua quis ipsum
                                                suspendisse ultrices gravida. Risus commodo viverra</p>
                                            <a href="#" class="btn_2">buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="img/banner_img.png" alt="">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="slider-counter"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->
         <section class="feature_part padding_top">          
            <div class="container">
                @if(session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
                    </div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section_tittle text-center">
                            <h2>Sản phẩm dành cho bạn</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-7 col-sm-6">
                        <div class="single_feature_post_text">
                            <p>Sản phẩm trong nhà</p>
                            <h3>Gia đình văn phòng</h3>
                            @foreach($loai1 as $value)
                                <a href="{{route('frontend.loai',['all' => $value->tenloai_slug])}}" class="feature_btn"
                                    >Khám phá ngay   <i class="fas fa-play"></i
                                ></a>
                            @endforeach    
                            <img src="{{asset('public/frontend/img/feature/giadinhvanphong.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6">
                        <div class="single_feature_post_text">
                            <p>Sản phẩm hỗ trợ</p>
                            <h3>Hỗ trợ máy tính</h3>
                            @foreach($loai2 as $value)
                                <a href="{{route('frontend.loai',['all' => $value->tenloai_slug])}}" class="feature_btn"
                                    >Khám phá ngay  <i class="fas fa-play"></i
                                ></a>
                            @endforeach 
                            <img src="{{asset('public/frontend/img/feature/webcam.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6">
                        <div class="single_feature_post_text">
                            <p>Sản phẩm hành trình </p>
                            <h3>Phương tiện giao thông</h3>
                            @foreach($loai3 as $value)
                                <a href="{{route('frontend.loai',['all' => $value->tenloai_slug])}}" class="feature_btn"
                                    >Khám phá ngay   <i class="fas fa-play"></i
                                ></a>
                            @endforeach 
                            <img src="{{asset('public/frontend/img/feature/hanhtrinh.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="single_feature_post_text">
                            <p>Sản phẩm ngoài trời</p>
                            <h3>Giám sát ngoài trời</h3>
                            @foreach($loai4 as $value)
                                <a href="{{route('frontend.loai',['all' => $value->tenloai_slug])}}" class="feature_btn"
                                    >Khám phá ngay  <i class="fas fa-play"></i
                                ></a>
                            @endforeach 
                            <img src="{{asset('public/frontend/img/feature/anninh.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- product_list start-->
    <section class="product_list section_padding">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Top Sản Phẩm <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product_list_slider owl-carousel">
                        <div class="single_product_list_slider">
                            <div class="row align-items-center justify-content-between">
                                @foreach($topsanpham as $value)
                                <div class="col-lg-3 col-sm-6">
                                    <div class="single_product_item">
                                        <a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" ><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" style="height:210px;" alt=""></a>
                                        <h4 class="namesanpham"><a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" ><?php echo Str::limit($value->tensanpham, 50); ?></a></h4>
                                        <div class="single_product_text">
                                             <h3 class="gia">{{ number_format($value->dongia) }} .vnd</h3>
                                             <div style="display:flex">
                                                <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $value->tensanpham_slug]) }}" class="add_cart">+ Thêm vào giỏ</a>
                                                @if (Auth::check())<a class="ml-4 add_cart d-flex justify-content-end" href="{{route('khachhang.sanphamthem',['tensanpham_slug'=>$value->tensanpham_slug])}}"><i class="ti-heart"></i></a>@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach   
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part start-->

    <!-- awesome_shop start-->
    <section class="our_offer section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6">
                    <div class="offer_img">
                        <img src="img/offer_img.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="offer_text">
                        <h2>Đăng ký để làm thành viên</h2>
                       
                        <div class="input-group">
                          
                            <div class="input-group-append">
                                <a href="{{route('khachhang.dangky')}}" class="input-group-text btn_2" id="basic-addon2">Đăng ký ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- awesome_shop part start-->

    <!-- product_list part start-->
    <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Sản Phẩm mới<i></i> <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                     @foreach($sanphammoi as $value)
                        <div class="single_product_item">
                            <a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" >  <img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" style="height:230px;" alt=""></a>
                            <div class="single_product_text">
                                <h4><?php echo Str::limit($value->tensanpham, 45); ?></h4>
                                <h3>{{ number_format($value->dongia) }} .vnd</h3>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part end-->

    <!-- subscribe_area part start-->
    <section class="subscribe_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="subscribe_area_text text-center">
                        <h5>Tham gia bản tin của chúng tôi</h5>
                        <h2>Đăng ký để được cập nhật
                            với những đề nghị mới</h2>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ Email"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">Chia sẻ ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::subscribe_area part end::-->

    <!-- subscribe_area part start-->
    <section class="client_logo padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                  @foreach($locth as $value)
                        <div class="single_client_logo">
                        <a href="{{route('frontend.thuonghieu',['all' => $value->tenthuonghieu_slug])}}"><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" style="height:70px;width:110px;"alt=""></a>
                        </div>
                    @endforeach
                    <!-- <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_2.png" alt="">
                    </div> -->
                    <!-- <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_3.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_4.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_5.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_3.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_1.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_2.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_3.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_4.png" alt="">
                    </div> -->
                </div>
            </div>
        </div>
    </section>
<style>
.namesanpham a{
  color: #000;
  text-transform: uppercase;
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 14px;
  display: block;
  margin-top: 10px;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  text-align: center;
}
.gia {
  color: #000;
  text-transform: uppercase;
  font-size: 18px;
  font-weight: 500;
  display: block;
  margin-top: 10px;
  -webkit-transition: 0.5s;
  transition: 0.5s;
}
</style>
    <!--::subscribe_area part end::-->
@endsection