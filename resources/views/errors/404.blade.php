@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>404</h2>
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
             <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Không tìm thấy trang.</h3>
                  <p class="mt-3">             
                  Chúng tôi không thể tìm thấy trang bạn đang tìm kiếm.
                  Trong khi đó, bạn có thể <a href="{{route('frontend')}}" class="btn_3"> trở lại trang chủ </a> hoặc thử sử dụng biểu mẫu tìm kiếm.
                  </p>             
          </div>
        
        </div>
    </div>
   
  </section>
  <hr>
@endsection