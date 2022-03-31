@extends('layouts.frontend')
@section('content')
    
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg" >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Sản Phẩm</h2>
              <p>Trang Chủ <span>-</span> Chi Tiết sản phẩm</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->
  <!--================End Home Banner Area =================-->

  <!--================Single Product Area =================-->
  <div class="product_image_area section_padding">
    <div class="container">
    @if(session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
            @endif
      <div class="row s_product_inner justify-content-between">
        <div class="col-lg-7 col-xl-7">
          <div class="product_slider_img">
            <div  id="vertical">
              @foreach($hinhanh as $value)
                <div data-thumb="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}">
                  <img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" />
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-xl-4">
          <div class="s_product_text">
            <h5>Chi Tiết <span>|</span> sản phẩm</h5>
            <h3>{{$sanpham->tensanpham}}</h3>
            <h2>{{ number_format($sanpham->dongia )}} .vnd</h2>
            <ul class="list">
              <li>
                <a class="" href="#">
                  <span>Dung lượng:</span> MicroSD  ≤ {{$sanpham->dungluong->dungluong}}</a>
              </li>
              <li>
                <a href="#"> <span>Thương hiệu</span> : {{$sanpham->thuonghieu->tenthuonghieu}}</a>
              </li>
            </ul>
          
            <div class="card_area d-flex justify-content-between align-items-center mt-3">
              <form class="row contact_form"  method="get" action="{{ route('frontend.giohang.them.chitiet',['tensanpham_slug' => $sanpham->tensanpham_slug]) }}">
                @csrf
                  <div class="product_count">
                    <input class="input-number" name="qty" type="number" value="1" min="1" max="10">
                  </div>
                  <button  type="submit"  class="btn_3 ml-2">Thêm vào giỏ</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->

  <!--================Product Description Area =================-->
  <section class="product_description_area">
    <div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Mô tả</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Cấu hình</a>
        </li>
       
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <p>{!!html_entity_decode($sanpham->motasanpham)!!}</p>
         
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    {!!html_entity_decode($sanpham->cauhinh)!!}
                  </td>
                 
                </tr>
               
              </tbody>
            </table>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Product Description Area =================-->

  <!-- product_list part start-->
  <section class="product_list best_seller">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="section_tittle text-center">
            <h2>Sản Phẩm Mới <span>shop</span></h2>
          </div>
        </div>
      </div>
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-12">
          <div class="best_product_slider owl-carousel">
          @foreach($sanphammoi as $value)
            <div class="single_product_item">
              <a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' => $value->tensanpham_slug])}}" ><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" style="height:200px;" alt=""></a>
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
@endsection
@section('javascript')
<script type="text/javascript">
	
		$('#vertical').lightSlider({
    gallery:true,
    item:1,
    vertical:true,
    verticalHeight:450,
    thumbItem:3,
    slideMargin:0,
    speed:600,
    autoplay: true,
    responsive : [
      {
          breakpoint:991,
          settings: {
              item:1,
              
            }
      },
      {
          breakpoint:576,
          settings: {
              item:1,
              slideMove:1,
              verticalHeight:350,
            }
      }
  ]
  });  
  
</script>
@endsection
