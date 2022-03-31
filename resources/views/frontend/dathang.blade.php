@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Đặt Hàng</h2>
              <p>Trang Chủ <span>-</span> Đặt Hàng</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Checkout Area =================-->
  <section class="checkout_area padding_top">
    <div class="container">
      <div class="returning_customer">
      @guest  
        <div class="check_title">
          <h2>
          Phản hồi khách hàng?
            <a href="#">Nhấn vào đây để đăng nhập</a>
          </h2>
        </div>
        <p>
        Nếu bạn đã mua sắm với chúng tôi trước đây, vui lòng nhập thông tin chi tiết của bạn vào ô bên dưới. Nếu bạn là người mới
                khách hàng, vui lòng chuyển đến phần Thanh toán & Giao hàng.
        </p>
        <form class="row contact_form" action="{{route('login')}}" method="post"  novalidate="novalidate">
        @csrf
          <div class="col-md-6 form-group p_star">
            <input type="text" class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" placeholder="Tên đăng nhập hoặc Email *" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username or Email*'" id="name"  value="{{ old('email') }}" name="email"  required />
            @if ($errors->has('email') || $errors->has('username'))
            <span class="placeholder" data-placeholder="Username or Email">
                 <strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong>    
            </span>
            @endif
          </div>
          <div class="col-md-6 form-group p_star">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu*" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password*'" id="password" name="password" equired />
                @error('password')
                    <span class="placeholder" data-placeholder="Password"><strong>{{ $message }}</strong></span>
                  @enderror
          </div>
          <div class="col-md-12 form-group">
            <button type="submit" value="submit" class="btn_3">
            Đăng nhập
            </button>
            <div class="creat_account">
              <input type="checkbox" id="f-option" name="selector" />
              <label for="f-option">Quên mật khẩu?</label>
            </div>
            <a class="lost_pass" href="#">Lost your password?</a>
          </div>
         
        </form>
        @else
        <div class="toggle_info">
                <span><i class="fas fa-user"></i> Bạn đã đăng nhập với tài khoản khách hàng <strong class="ml-2">{{ Auth::user()->name }}</strong>.</span>
            </div>
      @endguest
      </div>
      <div class="cupon_area">
        <div class="check_title">
          <h2>
          Có phiếu giảm giá? 
            <a href="#">Click here to enter your code</a>
          </h2>
        </div>
        
      </div>
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-7">
            <h3>Chi tiết thanh toán</h3>
            <form class="row contact_form"id="checkoutform" action="{{ route('frontend.dathang') }}" method="post" novalidate="novalidate">
            @csrf
              <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="name" name="name" placeholder="Họ và tên *" value="{{ Auth::user()->name ?? '' }}" required />
                  @error('user_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                  @enderror
              </div>
              <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control @error('diachigiaohang') is-invalid @enderror" id="diachigiaohang" name="diachigiaohang" placeholder="Địa chỉ giao hàng *" required />
                  @error('diachigiaohang')
                      <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                  @enderror
              </div>
 
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control @error('dienthoaigiaohang') is-invalid @enderror" id="dienthoaigiaohang" name="dienthoaigiaohang" placeholder="Điện thoại *" required />
                @error('dienthoaigiaohang')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Địa chỉ Email *" value="{{ Auth::user()->email ?? '' }}" required />
                  @error('email')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
              </div>
             
              <div class="col-md-12 form-group">
                <div class="creat_account">
                  <h3>Chi tiết vận chuyển?</h3>
                </div>
                <textarea class="form-control @error('chitietgiaohang') is-invalid @enderror" name="chitietgiaohang" id="chitietgiaohang" rows="1"
                  placeholder="Nội dung"></textarea>
              </div>
            </form>
          </div>
          <div class="col-lg-5">
            <div class="order_box">
              <h2>Đơn hàng của bạn</h2>
              <ul class="list">
                <li>
                  <a href="#">Sản phẩm 
                    <span>Thành tiền</span>
                  </a>
                </li>
                @foreach(Cart::content() as $value)
                <li>
                  <a href="#"> <?php echo Str::limit($value->name, 30); ?> 
                    <span class="middle">x {{ $value->qty }}</span>
                    <span class="last">{{ number_format($value->price * $value->qty) }}</span>
                  </a>
                </li>   
                @endforeach        
              </ul>
              <ul class="list list_2">
                <li>
                  <a href="#">Tổng tiền
                    <span>{{ Cart::subtotal() }} .vnd</span>
                  </a>
                </li>
                <li>
                  <a href="#">Phí vận chuyển
                    <span>Miễn phí vận chuyển</span>
                  </a>
                </li>
              
              </ul>
              <div class="payment_item">
                <div class="radion_btn">
                  <input type="radio" id="f-option5" name="selector" />
                  <label for="f-option5">Kiểm tra các khoản thanh toán</label>
                  <div class="check"></div>
                </div>
                <p>
                Vui lòng gửi séc đến Tên cửa hàng, Phố cửa hàng, Thị trấn cửa hàng,
                  Lưu trữ thị trấn / Quận, Lưu trữ Mã bưu điện.

                </p>
              </div>
              <div class="payment_item active">
                <div class="radion_btn">
                  <input type="radio" id="f-option6" name="selector" />
                  <label for="f-option6">Paypal </label>
                  <img src="{{asset('public/frontend/img/product/single-product/card.jpg' ) }}" alt="" />
                  <div class="check"></div>
                </div>
                <p>
                
                  Vui lòng gửi séc đến Tên cửa hàng, Phố cửa hàng, Thị trấn cửa hàng,
                  Lưu trữ Thị trấn / Quận, Lưu trữ Mã bưu điện.
                </p>
              </div>
              <!-- <div class="creat_account">
                <input type="checkbox" id="f-option4" name="selector" />
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms & conditions*</a>
              </div> -->
             
              <a class="button btn_3 mt-3" onclick="event.preventDefault();document.getElementById('checkoutform').submit();" href="{{ route('frontend.dathang') }}">Tiến hành đặt hàng</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection