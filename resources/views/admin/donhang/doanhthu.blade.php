@extends('layouts.app')
@section('title', 'Thống kê doanh thu')
@section('content')

@if(empty($doanhthu) == false)
<div class="card">
    <div class="card-body">         
        <form action="{{ route('admin.donhang.doanhthu') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center needs-validation" novalidate >
        @csrf
            <div class="col-4">
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Ngày bắt đầu</span>
                    <input type="date" class="form-control" id="validationCustomUsername" name="dateStart" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày bắt đầu.
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">Ngày kết thúc</span>
                <input type="date" class="form-control" id="validationCustomUsername" name="dateEnd" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày kết thúc 
                    </div>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary">Thống kê <i class="fas fa-chart-line"></i></button>
            </div>
        </form>
    </div> 
    
    @if( $doanhthu->count() == null)
    <div class="alert alert-success text-center" role="alert">
        <p>không có sản phẩm nào được bán ra trong thời gian từ <strong>{{date('d-m-Y', strtotime($session_title_dateStart))}}</strong> đến <strong> {{date('d-m-Y', strtotime($session_title_dateEnd))}}</strong></p>
    </div>
    @else
    <div class="card-body table-responsive">
    <h4 class="text-center">Doanh thu từ <strong>{{date('d-m-Y', strtotime($session_title_dateStart))}}</strong> đến <strong> {{date('d-m-Y', strtotime($session_title_dateEnd))}}</strong></h4>

            <table id="table_id" class="table table-bordered table-hover ">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="50%">Tên sản phẩm</th>
                        <th width="15%">Số lượng bán  </th>
                        <th width="15%">Đơn giá </th>
                        <th width="15%">Tổng tiền </th>
                    </tr>
                </thead>
                <tbody>
                    @php $tong = 0; @endphp
                    @foreach($doanhthu as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->tensanpham }}</td>
                        <td class="text-center">{{number_format($value->tongsoluongban) }}</td>
                        <td>{{number_format($value->dongia) }}</td>   
                        <td>{{number_format($value->tongsoluongban * $value->dongia) }}</td>                
                    </tr>
                    @php $tong += $value->tongsoluongban * $value->dongia; @endphp
                    @endforeach
                    <tr >
                        <td colspan="4" class="fw-bold" >Tổng doanh thu</td>
                        <td colspan="4" class="fw-bold">{{number_format( $tong) }} VNĐ</td>

                    </tr>
                </tbody>
            </table>
        </div>
        @endif
</div>

@else
<div class="card">
    <div class="card-body">         
        <form action="{{ route('admin.donhang.doanhthu') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center needs-validation" novalidate >
        @csrf
            <div class="col-4">
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">Ngày bắt đầu</span>
                    <input type="date" class="form-control" id="validationCustomUsername" name="dateStart" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày bắt đầu.
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">Ngày kết thúc</span>
                <input type="date" class="form-control" id="validationCustomUsername" name="dateEnd" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Vui lòng chọn ngày kết thúc 
                    </div>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary">Thống kê <i class="fas fa-chart-line"></i></button>
            </div>
        </form>
    </div> 
</div>

@endif

<script>
    (function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection