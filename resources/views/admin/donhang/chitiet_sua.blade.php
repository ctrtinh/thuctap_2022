@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Chỉnh sửa đơn hàng</div>
        <div class="card-body">
            <form action="{{ route('admin.donhang.chitiet.sua', ['id' => $donhang_chitiet->id]) }}" method="post">
            @csrf

                <div class="mb-3">
                    <label class="form-label" for="sanpham_id">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="user" name="user_id" value="{{ $donhang_chitiet->SanPham->tensanpham }}" disabled required />
                    @error('sanpham_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="soluongban">Số lượng</label>
                    <input type="text" class="form-control @error('soluongban') is-invalid @enderror" id="soluongban" name="soluongban" value="{{ $donhang_chitiet->soluongban }}" required />
                    @error('soluongban')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="dongiaban">Đơn giá bán</label>
                    <input type="text" class="form-control @error('dongiaban') is-invalid @enderror" id="dongiaban" name="dongiaban" value="{{ $donhang_chitiet->dongiaban
                     }}" required />
                    @error('dongiaban')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
            </form>
        </div>
    </div>
@endsection