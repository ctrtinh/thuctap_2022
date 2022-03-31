
<!-- <div class="container">


<div class="row justify-content-center">

    <div class="col-xl-8 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-0">
            <div class="card-body p-0">
               
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h2 text-gray-1200 mb-4">Đăng nhập</h1>
                            </div> 
                            @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <span class="font-weight-bold text-danger">
                                    <i class="fal fa-exclamation-triangle"></i> {{ session('warning') }}
                                </span>
                            </div>
                            @endif
                            <form method="post" action="{{ route('login') }}" class="user">
                            @csrf
                                <div class="mb-3 form-group">
                                    <input  type="text" class="fs-6 form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }} form-control-user"
                                    id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email hoặc tên đăng nhập">                     
                                        @if ($errors->has('email') || $errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="mb-3 form-group">
                                    <input type="password" class="fs-6 form-control @error('password') is-invalid @enderror form-control-user"
                                    id="password" name="password"  placeholder="Mật khẩu">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="feedback-recaptcha">Xác thực đăng nhập</label>
                                        <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                            data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                                            data-size="normal"
                                            data-theme="light">
                                        </div>
                                        @error('g-recaptcha-response')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="remember">Duy trì đang nhập</label>
                                                   
                                            </div>
                                        </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    Đăng nhập
                                </button>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                     @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                    @endif
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div> -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CameraStore - Đăng Nhập</title>

   
    <link href="{{ asset('public/admin/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  
    <link href="{{ asset('public/admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
    @if(session()->has('success'))
            <div class="alert alert-success thongbao">
               {{ session()->get('success') }}
            </div>
    @endif
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block "><img src="{{ asset('public/admin/img/logo/Arlo-Camera-Pro-2-4-square (2).png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng Nhập Quản Trị</h1>
                                    </div>
                                    @if(session('warning'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <span class="font-weight-bold text-danger">
                                                <i class="fal fa-exclamation-triangle"></i> {{ session('warning') }}
                                            </span>
                                        </div>
                                    @endif
                                    <form method="post" action="{{ route('login') }}" class="user">
                                       @csrf
                                        <div class="form-group">
                                            <input type="text" class="fs-6 form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }} form-control-user"
                                            id="email" name="email" value="{{ old('email') }}"
                                                placeholder="Email hoặc tên đăng nhập">
                                                @if ($errors->has('email') || $errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="fs-6 form-control @error('password') is-invalid @enderror form-control-user"
                                    id="password" name="password"  placeholder="Mật khẩu">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="feedback-recaptcha">Xác thực đăng nhập</label>
                                                <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                                    data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                                                    data-size="normal"
                                                    data-theme="light">
                                                </div>
                                                @error('g-recaptcha-response')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="remember">Duy trì đang nhập</label>
                                                   
                                            </div>
                                        </div>
                                            <button class="btn btn-primary btn-user btn-block">
                                                Đăng nhập
                                            </button>

                                        
                                   
                                    <hr>
                                    <div class="text-center">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                            @endif
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 
    <script src="{{ asset('public/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>


    <script src="{{ asset('public/admin/js/sb-admin-2.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js?hl=vi" async defer></script>
</body>

