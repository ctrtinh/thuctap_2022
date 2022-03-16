@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Đăng Nhập</h2>
                            <p>Trang Chủ <span>-</span> Đăng Nhập</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================login_part Area =================-->
    <section class="login_part padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>Mới vào trang web của chúng tôi?</h2>
                            <p>Có những tiến bộ trong khoa học và công nghệ hàng ngày, và một ví dụ điển hình về điều này là</p>
                            <a href="{{route('khachhang.dangky')}}" class="btn_3"> Tạo một tài khoản</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
							<h3>Đăng nhập vào</h3>
							@if (session('status'))
                        <div id="AlertBox" class="alert alert-success " role="alert">
                            {!! session('status') !!}
                        </div>
                    @endif
                            <form class="row contact_form" action="{{ route('login') }}" method="post" novalidate="novalidate">
							@csrf
                                <div class="col-md-12 form-group p_star">
								<input type="text" class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" id="email" name="email"  value="{{ old('email') }}" placeholder="Tên đăng nhập" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tên đăng nhập'"required />
									@if ($errors->has('email') || $errors->has('username'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong>
										</span>
									@endif
                                </div>
                                <div class="col-md-12 form-group p_star">
								<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"required />
									@error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Duy trì đăng nhập</label>
                                    </div>
                                    <button type="submit" value="submit" class="btn_3">
									Đăng nhập
                                    </button>
                                    <a class="lost_pass" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                </div>
                                <div class="col-md-12 form-group list_none d-flex justify-content-center">
								<ul class="d-flex justify-content-evenly	">
                                    <li class="nav-item mr-3 "><a href="" class="button button-header"><i class="fab fa-facebook"></i> Facebook</a></li>
                                    <li class="nav-item"><a href="{{ route('google.login') }}" class="button button-header"><i class="fab fa-google-plus-g"></i>Google</a></li>
                                </ul>   
							</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

    @endsection