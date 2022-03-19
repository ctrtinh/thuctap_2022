@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Khách Hàng</h2>
              <p>Trang Chủ <span>-</span> Khách Hàng</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================ confirmation part start =================-->
  <section class="confirmation_part padding_top">
    <div class="container">
      <div class="row">
       
        <div class="col-lg-4 col-lx-3">
          <div class="single_confirmation_details">
            <h4>Menu</h4>
            <ul>
            <li  style="padding-left: 5%;"><a href="{{ route('khachhang') }}" class="button button-header " style="width: 270px"> Trang chủ </a></li>
                <li  style="padding-left: 5%;"><a href="{{ route('khachhang.donhang') }}" class="button button-header mt-1" style="width: 270px">Đơn hàng của tôi</a></li>
                <li  style="padding-left: 5%;"><a href="{{ route('khachhang.hoso') }}" class="button button-header mt-1" style="width: 270px"> Thông tin cá nhân</a></li>
                <li  style="padding-left: 5%;"><a href="{{route('khachhang.danhsachsanpham')}}" class="button button-header mt-1" style="width: 270px"> Sản phẩm yêu thích</a></li>
                <li  style="padding-left: 5%;">
                  <a href="{{ route('logout') }}" class="button button-header mt-1" style="width: 270px" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      Đăng xuất   
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                    @csrf
                  </form>
                </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-8 col-lx-4">
          <div class="single_confirmation_details">
            <h4>Chào Mừng {{Auth::user()->name}}.</h4>
            <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donhang as $value)
                  <tr>
                      <th>{{ $value->SanPham->tensanpham }}</th>
                      <th>{{ $value->soluongban }}</th>
                      <th>{{  number_format($value->dongiaban) }}</th>
                      <th>{{ number_format($value->dongiaban * $value->soluongban) }}</th>
                  </tr>
                @endforeach
            </tbody>
            
        </table> 
          </div>
        </div>
       
      </div>
    
    </div>
  </section>
  <!--================ confirmation part end =================-->

@endsection