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
       
        <div class="col-lg-4 col-lx-3 ">
          <div class="single_confirmation_details">
            <h4>Menu</h4>
            <ul>
            <li  style="padding-left: 5%;"><a href="{{ route('khachhang') }}" class="button button-header " style="width: 270px"> Trang chủ </a></li>
                <li  style="padding-left: 5%;"><a href="{{ route('khachhang.donhang') }}" class="button button-header mt-1" style="width: 270px">Đơn hàng của tôi</a></li>
                <li  style="padding-left: 5%;"><a href="{{ route('khachhang.hoso') }}" class="button button-header mt-1" style="width: 270px"> Thông tin cá nhân</a></li>
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
            <table class="order-rable">
               <thead>
                    <tr>
                        <th scope="col" width="20%">Điện thoại giao hàng</th>
                        <th scope="col" width="35%">Địa chỉ giao hàng</th>
                        <th scope="col" >Ngày đặt</th>
                        <th scope="col"  >Tình Trạng</th>
                        <th scope="col" width="5%">Chi tiết</th>
                        <th scope="col" ></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($donhang as $value)
                    <tr>
                        <th>{{ $value->dienthoaigiaohang }}</th>
                        <th>{{ $value->diachigiaohang }}</th>
                        <th>{{ $value->created_at }}</th>
                        <th>{{ $value->TinhTrang->tinhtrang }}</th>
                        <th>
                            <a href="{{ route('khachhang.donhang.chitiet',['id' => $value->id])}}"><i class="fas fa-info-circle"></i></a>
                        </th>
                        <th>
                        @if($value->tinhtrang_id === 1 or $value->tinhtrang_id === 2 )
                            <a href="{{ route('khachhang.donhang.huy',['id' => $value->id])}}" class="genric-btn danger radius" >Hủy</a>
                        @elseif($value->tinhtrang_id === 3)
                            <a href=""class="genric-btn btn btn-danger disabled radius" >Đã hủy</a>
                        @else
                            <a href="{{ route('khachhang.donhang.huy',['id' => $value->id])}}" class="genric-btn disable radius"></a>
                        @endif


                        </th>
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