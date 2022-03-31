@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Sản Phẩm</h2>
                        <p>Trang Chủ <span>-</span> Sản Phẩm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- breadcrumb start-->
@if(count($sanpham) <= 0)    
<section class="cat_product_area section_padding">
    <div class="container">
        <div class="row">
            <h3>Xin lỗi về sự bất tiện :</h3>
            <p>             
                 Hiện tại chưa có sản phẩm thuộc <strong> {{ $session_title}} </strong>. 
            Bạn có thể <a href="{{route('frontend')}}" class="genric-btn success medium circle">trở lại trang chủ</a> để xem sản phẩm khác.
            </p> 
        </div>
    </div>
</section>
@else
<!--================Category Product Area =================-->
<section class="cat_product_area section_padding">
    <div class="container">
          @if(session()->has('status'))
			<div class="alert alert-success">
				{{ session()->get('status') }}
			</div>
		    @endif
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Loại Sản Phẩm</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach($locloai as $value)
                                    <li>
                                        <a href="{{route('frontend.loai',['all' => $value->tenloai_slug])}}">{{ $value->tenloai }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <hr>
                            </div>
                        </aside>
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Thương Hiệu</h3>
                        </div>
                        <div class="widgets_inner">    
                            <ul class="list">
                                @foreach($locth as $value)
                                <li>
                                    <a href="{{route('frontend.thuonghieu',['all' => $value->tenthuonghieu_slug])}}">{{ $value->tenthuonghieu }}</a> 
                                </li>
                                @endforeach
                            </ul>
                            <hr>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Dung Lượng</h3>
                        </div>
                        <div class="widgets_inner">           
                            <ul class="list">
                                @foreach($locdungluong as $value)
                                    <li>
                                        <a href="{{route('frontend.dungluong',['all' => $value->dungluong_slug])}}">{{ $value->dungluong }}</a>
                                    </li>
                                @endforeach 
                            </ul>
                        </div>
                    </aside>

                    <!-- <aside class="left_widgets p_filter_widgets price_rangs_aside">
                        <div class="l_w_title">
                            <h3>Price Filter</h3>
                        </div>
                        <div class="widgets_inner">
                            <div class="range_item">
                                <div id="slider-range"></div>
                                <input type="text" class="js-range-slider" value="" />
                                <div class="d-flex">
                                    <div class="price_text">
                                        <p>Price :</p>
                                    </div>
                                    <div class="price_value d-flex justify-content-center">
                                        <input type="text" class="js-input-from" id="amount" readonly />
                                        <span>to</span>
                                        <input type="text" class="js-input-to" id="amount" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside> -->
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <!-- <div class="single_product_menu">
                                <p><span>10000 </span> Prodict Found</p>
                            </div> -->
                            <div class="single_product_menu d-flex">
                                <h5>Sắp xếp : </h5>
                                <form action="{{ route('frontend.sanpham') }}" method="get">
                                    @csrf 
                                    <select name="select1" id="select1" onchange="if(this.value != 0) { this.form.submit(); }">
                                        <option value="default" {{ session('select1') == 'default' ? 'selected' : '' }}> Sắp xếp mặc định</option>
                                        <option value="BUY"{{ session('select1') == 'BUY' ? 'selected' : '' }}>Mua nhiều nhất</option>  
                                        <option value="NEW"{{ session('select1') == 'NEW' ? 'selected' : '' }}>Hàng mới nhất</option>
                                        <option value="ASC"{{ session('select1') == 'ASC' ? 'selected' : '' }}>Giá thấp đến cao</option>
                                        <option value="DESC"{{ session('select1') == 'DESC' ? 'selected' : '' }}>Giá cao đến thấp</option>
                                    </select>
                                </form>
                            </div>
                            <div class="single_product_menu d-flex">
                            <h5>Hiện theo trang : </h5>
                                <form action="{{ route('frontend.trang') }}" method="post">
                                    @csrf 
                                    <select name="select" id="select" onchange="if(this.value != 0) { this.form.submit(); }">
                                        <option value="9" {{ session('select') == 'default' ? 'selected' : '' }}> Hiện thị mặc định</option>
                                        <option value="12"{{ session('select') == '12' ? 'selected' : '' }}>12 mỗi trang</option>
                                        <option value="15"{{ session('select') == '15' ? 'selected' : '' }}>15 mỗi trang</option>
                                        <option value="18"{{ session('select') == '18' ? 'selected' : '' }}>18 mỗi trang</option>
                                        <option value="21"{{ session('select') == '21' ? 'selected' : '' }}>21 mỗi trang</option>
                                    </select>      
                                </form>
                            </div>
                            <div class="single_product_menu d-flex">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="search"
                                        aria-describedby="inputGroupPrepend">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="ti-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center latest_product_inner">
                 @foreach($sanpham as $value)
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" > <img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" style="height:210px;" alt=""></a>
                                    <h4 class="namesanpham"><a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" ><?php echo Str::limit($value->tensanpham, 50); ?></a> </h4>
                                    
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
                    <div class="col-lg-12">
                        <div class="pageination">
                            <nav aria-label="Page navigation example"> 
                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                    {{ $sanpham->links() }}
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#"></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->

<!-- product_list part start-->
<section class="product_list best_seller">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Sản Phẩm Bán Chạy</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-12">
                <div class="best_product_slider owl-carousel">
                @foreach($topsanpham as $value)
                    <div class="single_product_item">
                    <a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" ><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}"style="height:200px;" alt=""></a>
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
@endif
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
@endsection