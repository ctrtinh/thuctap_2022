@extends('layouts.app')
@section('title', 'Thông tin cá nhân')

@section('content')
@if (session('status'))
<div id="AlertBox" class="alert alert-success hide" role="alert">
    {!! session('status') !!}
</div>
@endif
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('public/admin/img/logo/staff.png')}}"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{Auth::user()->name}} </h3>
                <p class="text-muted text-center">{{Auth::user()->role}}</p>
              </div>
            </div>
          </div>

          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                @if($baiviet->count() == 0)
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Thông tin cá nhân</a></li>
                  @else
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Bài viết của tôi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Thông tin cá nhân</a></li>
                  @endif
                </ul>
              </div>

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    @foreach($baiviet as $value)

                      <div class="post">
                        <h2>{{$value->tieude}}</h2>
                          <p>
                            {{$value->tomtat}}
                          </p>

                          <p>
                            <i class="fas fa-eye mr-1"></i> Lượt xem ({{$value->luotxem}})
                           
                              <a  href="{{ route('admin.binhluan', ['tieude_slug' => $value->tieude_slug]) }}"  class="link-black text-sm" style="text-decoration:none;"><i class="far fa-comments mr-1"></i> Bình luận ( {{ $value->BinhLuan->count()}})</a>
                           
                              

                         
                              <span class="float-right">
                              <a href="{{ route('admin.baiviet.sua.info', ['id' => $value->id]) }}" class="link-black text-sm" style="text-decoration:none;">
                                <i class="fas fa-edit text-info"></i> Sửa
                              </a>
                              <a href="{{ route('admin.baiviet.xoa.info', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa bài viết {{ $value->tieude}} không?')" style="text-decoration:none;">
                                <i class="fas fa-trash-alt text-danger"></i> Xóa
                              </a>
                            </span>
                          </p>
                      </div>    
                    @endforeach      
                  </div>

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="{{ route('admin.nguoidung.sua.info', ['id' => Auth::user()->id]) }}" method="post">
                      @csrf
                      <div class="mb-3">
                          <label class="form-label" for="name">Họ và tên</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" required />
                          @error('name')
                              <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                          @enderror
                      </div>

                      <div class="mb-3">
                          <label class="form-label" for="email">Địa chỉ email</label>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" required />
                          @error('email')
                              <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                          @enderror
                      </div>                     

                      <div class="mb-3 form-check">
                          <input class="form-check-input" type="checkbox" id="change_password_checkbox" name="change_password_checkbox" />
                          <label class="form-check-label" for="change_password_checkbox">Đổi mật khẩu</label>
                      </div>

                      <div id="change_password_group">
                          <div class="mb-3">
                              <label class="form-label" for="password">Mật khẩu mới</label>
                              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
                              @error('password')
                                  <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" />
                              @error('password_confirmation')
                                  <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                              @enderror
                          </div>
                      </div>

                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        $("#change_password_group").hide();
        $("#change_password_checkbox").change(function() {
            if($(this).is(":checked"))
            {
                $("#change_password_group").show();
                $("#change_password_group :input").attr("required", "required");
            }
            else
            {
                $("#change_password_group").hide();
                $("#change_password_group :input").removeAttr("required");
            }
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $('#AlertBox').removeClass('hide');
        $('#AlertBox').delay(2000).slideUp(500);
    });
</script>
@endsection
