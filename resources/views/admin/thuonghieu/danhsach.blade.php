@extends('layouts.app')
@section('title', 'Thương hiệu camera')
@section('content')

<div class="card">
    <div class="card-body table-responsive">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        <p>
            <a href="{{ route('admin.thuonghieu.them') }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm mới</a>
            <a href="#nhap" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fas fa-upload"></i> Nhập từ Excel</a>
            <a href="{{ route('admin.thuonghieu.xuat') }}" class="btn btn-success"><i class="fas fa-download"></i> Xuất ra Excel</a>
        </p>
        <table id="table_id" class="table table-bordered table-hover table-sm ">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="35%">Tên thương hiệu </th>
                    <th width="30%">Tên thương hiệu không dấu</th>
                    <th width="20%">Hình ảnh </th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($thuonghieu as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->tenthuonghieu }}</td>
                        <td>{{ $value->tenthuonghieu_slug }}</td>
                        <td class="text-center"><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" width="100" class="img-thumbnail"/></td>                   
                        <td class="text-center"><a href="{{ route('admin.thuonghieu.sua', ['id' => $value->id]) }}"><i class="fa fa-edit"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.thuonghieu.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa thương hiệu {{ $value->tenthuonghieu}} không?')"><i class="fa fa-trash-alt text-danger"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 </div>
 <form action="{{ route('admin.thuonghieu.nhap') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-0">
                        <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
                        <input type="file" class="form-control" id="file_excel" name="file_excel" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Hủy bỏ</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-upload"></i> Nhập dữ liệu</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $('#AlertBox').removeClass('hide');
        $('#AlertBox').delay(2000).slideUp(500);
    });
</script>
@endsection