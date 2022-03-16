@extends('layouts.frontend')
@section('content')	
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Đặt Hàng Thành Công</h2>
              <p>Home <span>-</span> Order Confirmation</p>
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
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span>Cảm ơn bạn. Đơn đặt hàng của bạn đã được ghi nhận, vui lòng check gmail để xem chi tiết hoặc theo dõi phía dưới</span>
          </div>
        </div>      
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="order_details_iner">
            <h3>Chi tiết đặt hàng</h3>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Sản phẩm</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Đơn giá</th>
                </tr>
              </thead>
              <tbody>
              @foreach($cart as $value)
                <tr>
                  <th colspan="2"><span>{{ $value->name }}</span></th>
                  <th>x {{$value->qty}}</th>
                  <th> <span>{{number_format($value->price)}}</span></th>
                </tr>
                @endforeach     
                <tr>
                  <th colspan="3">Tổng tiền phải trả</th>
                  <th> <span>{{ $cartsub }}</span></th>
                </tr>
                <tr>
                  <th colspan="3">shipping</th>
                  <th><span>Free ship</span></th>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col" colspan="3">Tổng số lượng</th>
                  <th scope="col">Tổng tiền {{ $cartsub }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ confirmation part end =================-->
  @endsection

