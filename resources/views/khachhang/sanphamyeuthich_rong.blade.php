@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Sản Phẩm Yêu Thích Của Bạn</h2>
              <p>Trang Chủ <span>-</span>Sản Phẩm Yêu Thích Của Bạn</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
  <section class="confirmation_part padding_top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
          <h2>Chưa có sản phẩm yêu thích trong giỏ hàng.</h2>                    
          <span class="mt-3"><a  href="{{route('frontend')}}" class="btn_3">Tìm sản phẩm yêu thích</a ></span>
        
          </div>
          <span  class="d-flex justify-content-center mt-4">  <img width="400" src="{{asset('public/frontend/img/cart.png')}}" alt=""></span>
        
        </div>
    </div>
  </section>
@endsection