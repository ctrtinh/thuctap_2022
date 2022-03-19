@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Giỏ Hàng</h2>
              <p>Trang Chủ <span>-</span>Giỏ Hàng</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
  <section class="cart_area padding_top">
    <div class="container">
    @if (session('status'))
        <div id="AlertBox" class="alert alert-success hide" role="alert">
            {!! session('status') !!}
        </div>
    @endif
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" width="50%">Sản phẩm</th>
                <th scope="col" width="15%">Giá</th>
                <th scope="col"width="10%">Số lượng</th>
                <th scope="col" width="20%">Thành tiền</th>
                <th scope="col" width="5%">Xóa</th>
              </tr>
            </thead>
            <tbody>
            @foreach(Cart::content() as $value)
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img src="{{ env('APP_URL') . '/storage/app/' . $value->options->image }}"style="height:100px;width:100px; "alt="" />
                    </div>
                    <div class="media-body">
                      <p>{{ $value->name }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>{{ number_format($value->price) }}</h5>
                </td>
                <td>
                  <div class="product_count">
                    <span class="input-number-decrement"> <a  href="{{ route('frontend.giohang.giam', ['row_id' => $value->rowId]) }}"><i class="ti-angle-down"></i></a></span>
                    <input class="qty" name="qty" id="qty" type="text" value="{{ $value->qty }}" min="1" max="10">
                    <span class="input-number-increment"> <a  href="{{ route('frontend.giohang.tang', ['row_id' => $value->rowId]) }}"><i class="ti-angle-up"></i></a></span>
                  </div>
                </td>
                <td>
                  <h5>{{ number_format($value->price * $value->qty) }}</h5>
                </td>
                <td><a href="{{route('frontend.giohang.xoa',['row_id' => $value->rowId])}}"><i class="fas fa-trash-alt"></i></a></td>
              </tr>
              @endforeach
                <td></td>
                <td></td>
                <td>
                  <h5>Tổng Tiền</h5>
                </td>
                <td>
                  <h5>{{ Cart::subtotal() }}</h5>
                </td>
              </tr>
              <tr class="shipping_area">
                <td></td>
                <td></td>
                <td></td>
              
                <td>
                  <div class="shipping_box">
                    
                    <a class="btn_1" href="{{ route('frontend.giohang.xoatatca') }}">Xóa Giỏ Hàng</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
                <a class="btn_1" href="{{route('frontend.index')}}">Tiếp tục mua hàng</a>
                @if(!Auth::check())
                <a class="btn_1 checkout_btn_1" href="{{route('khachhang.dangnhap')}}">Đăng nhập để tiếp tục đặt hàng </a>
                @else
                <a class="btn_1 checkout_btn_1" href="{{route('frontend.dathang')}}">Tiến hành thanh toán</a>
                @endif
          </div>
        </div>
      </div>
  </section>
@endsection