@extends('layouts.app')
@section('title', 'Hình ảnh')
@section('content')
    <div class="card">
        <div class="card-header">Thêm hình ảnh </div>
        <div class="card-body">
            <form action="{{ route('admin.hinhanh.them',['tensanpham_slug' => $sanpham->tensanpham_slug]) }}" method="post" enctype="multipart/form-data">
                @csrf          
                <div class="mb-3">
                    <label class="form-label" for="HinhAnh">Hình ảnh</label>
                    <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror"  name="HinhAnh[]"  multiple />
                    @error('HinhAnh')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>          
                <button type="submit" class="btn btn-primary"> Thêm vào CSDL</button>
            </form>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection