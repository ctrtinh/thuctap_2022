@extends('layouts.app')
@section('content')
<div class="card-body text-center">
    <h3 >Chào mừng bạn đến với trang quản trị <span class="text-info">CameraStore</span></h3>    
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Đơn hàng mới</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($donhang)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>         
                </div> 
                   
            </div>
            <div class="text-center">
                    <a href="{{route('admin.donhang.moi')}}" class="small-box-footer center">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>   
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Doanh thu hôm nay</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        @php $tongtien=0; @endphp
                            @foreach($doanhthu as $value)
                                @php $tongtien += $value->tongsoluongban * $value->dongia; @endphp
                            @endforeach
                            {{number_format($tongtien)}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{route('admin.donhang.ngay')}}" class="small-box-footer center">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>  
        </div>
        
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đăng ký người dùng
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($user)}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div> 
        </div>
        <div class="text-center">
            <a href="{{route('admin.nguoidung')}}" class="small-box-footer center">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
        </div> 
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                       Bình luận</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $binhluan->count() }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
            </div>
            
        </div>
        <div class="text-center">
            <a href="{{route('admin.binhluan.danhsach')}}" class="small-box-footer center">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
        </div> 
    </div>
</div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <div class="card-header border-0">
            <h3 class="card-title">Sản phẩm hết hàng</h3>
            <div class="card-tools d-flex justify-content-end">
            <a href="{{route('admin.sanpham.het.xuat')}}" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
            </a>
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
            </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($sanpham as $value)
                    <tr>
                        <td>{{$value->tensanpham}}</td>
                        <td>{{ number_format($value->dongia)}} </td> 
                    </tr>  
                    @endforeach              
            </tbody>
            </table>
        </div>
        </div>          
    </div>
    </div>
</div>
</div>
 
@endsection
