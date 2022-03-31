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
  <section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thêm vào giỏ</th>
                <th scope="col">Xóa</th>
              </tr>
            </thead>
            <tbody>
            @foreach($danhsach as $value)
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                       <img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}"style="height:100px;width:100px;" alt="" />                
                    </div>
                  </div>
                </td>
                <td><a href="{{route('frontend.sanpham.chitiet',['tensanpham_slug' =>$value->SanPham->tensanpham_slug])}}">{{ $value->sanpham->tensanpham }}</a></td>
                <td>
                  <h5>{{ number_format($value->SanPham->dongia) }}</h5>
                </td>
                <td class="li-product-add-cart">
                  <div class="product_count">
                    <a href="{{ route('frontend.giohang.them', ['tensanpham_slug' =>$value->SanPham->tensanpham_slug]) }}">Thêm vào giỏ</a>
                  </div>
                </td>
                <td><a href="{{ route('khachhang.sanpham', ['id' => $value->id]) }}"><i class="fas fa-trash-alt"></i></a></td>
              </tr>
              @endforeach 
            
            </tbody>
          </table>
         
        </div>
      </div>
  </section>
@endsection