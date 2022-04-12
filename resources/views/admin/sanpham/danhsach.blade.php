@extends('layouts.app')
@section('title', 'Sản phẩm')
@section('content')

<div class="card">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        <div class="card-body table-responsive">
        <p>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <a href="{{ route('admin.sanpham.them') }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm mới</a>
            <a href="#nhap" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fas fa-upload"></i> Nhập từ Excel</a>
            <a href="{{ route('admin.sanpham.xuat') }}" class="btn btn-success"><i class="fas fa-download"></i> Xuất ra Excel</a>
        </p>
        <table id="table_id" class="table table-bordered table-hover table-sm ">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="10%">Thương hiệu</th>
                    <th width="10%">Loại </th>
                    <th width="20%">Tên sản phẩm</th>
                    <th width="20%">Tên sản phẩm không dấu</th>
                    <th width="7%">Số lượng</th>
                    <th width="10%">Dung lượng</th>
                    <th width="10%">Đơn giá</th>
                    <th width="10%">Hiển thị</th>
                    <th width="8%">Hình ảnh</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
            @foreach($sanpham as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->ThuongHieu->tenthuonghieu }}</td>
                    <td>{{ $value->Loai->tenloai }}</td>
                    <td>{{ $value->tensanpham }}</td>
                    <td>{{ $value->tensanpham_slug }}</td>
                    <td class="text-end">{{ $value->soluong }}</td>
                    <td>    @if($value->tendungluong == null)
                                Không có
                            @else
                                {{$value->tendungluong}}
                            @endif
                    </td>
                    <td class="text-end">{{ number_format($value->dongia) }}</td>
                    <td class="text-center">
                            @if($value->hienthi == 1)
                                <a href="{{ route('admin.sanpham.OnOffHienThi', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                            @else
                                <a href="{{ route('admin.sanpham.OnOffHienThi', ['id' => $value->id]) }}"><i class="fas fa-ban text-danger"></i></a>           
                            @endif
                        </td>
                    <td class="text-center"><a href="{{ route('admin.hinhanh',['tensanpham_slug' => $value->tensanpham_slug]) }}"><i class="fas fa-images"></i></a></td>               
                    <td class="text-center"><a href="{{ route('admin.sanpham.sua', ['id' => $value->id]) }}"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="{{ route('admin.sanpham.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham}} không?')"><i class="fa fa-trash-alt text-danger"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 </div>
 <form action="{{ route('admin.sanpham.nhap') }}" method="post" enctype="multipart/form-data">
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
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $('#AlertBox').removeClass('hide');
        $('#AlertBox').delay(2000).slideUp(500);
    });
</script>
@endsection