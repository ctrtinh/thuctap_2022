@extends('layouts.app')
@section('title', 'Sản phẩm')

@section('content')
    <div class="card">
        <div class="card-header">Thêm camera  </div>
        <div class="card-body">
            <form action="{{ route('admin.sanpham.them') }}" method="post" enctype="multipart/form-data">
                @csrf          
                <div class="mb-3">
                    <label class="form-label" for="thuonghieu_id">Thương hiệu</label>
                    <select class="form-control @error('thuonghieu_id') is-invalid @enderror" name="thuonghieu_id" id="thuonghieu_id" value="{{ old('thuonghieu_id') }}" > 
                        <option value="">-- Chọn thương hiệu --</option>
                        @foreach($thuonghieu as $value)
                            <option value="{{ $value->id }}">{{ $value->tenthuonghieu }}</option>
                        @endforeach
                    </select>
                    @error('thuonghieu_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>               
                <div class="mb-3">
                    <label class="form-label" for="loai_id">Loại </label>
                    <select class="form-control @error('loai_id') is-invalid @enderror" name="loai_id" id="loai_id" value="{{ old('loai_id') }}"> 
                        <option value="">-- Chọn loại --</option>
                        @foreach($loai as $value)
                            <option value="{{ $value->id }}">{{ $value->tenloai }}</option>
                        @endforeach
                    </select>
                    @error('loai_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div> 
                <div class="mb-3">
                    <label class="form-label" for="dungluong_id">Dung Lượng </label>
                    <select class="form-control @error('dungluong_id') is-invalid @enderror" name="dungluong_id" id="dungluong_id" value="{{ old('dungluong_id') }}"> 
                        <option value="">-- Chọn dung lượng --</option>
                        @foreach($dungluong as $value)
                            <option value="{{ $value->id }}">{{ $value->dungluong }}</option>
                        @endforeach
                    </select>
                    @error('dungluong_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div> 
                <div class="mb-3">
                    <label class="form-label" for="tensanpham">Tên camera </label>
                    <input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham" name="tensanpham"  value="{{ old('tensanpham') }}" />
                    @error('tensanpham')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>   
                <div class="mb-3">
                    <label class="form-label" for="soluong">Số lượng</label>
                    <input type="number" class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong"  value="{{ old('soluong') }}"  />
                    @error('soluong')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>  
                <div class="mb-3">
                    <label class="form-label" for="dongia">Đơn giá</label>
                    <input type="number" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{ old('dongia') }}"  />
                    @error('dongia')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div> 
                <div class="mb-3">
                    <label class="form-label" for="HinhAnh">Hình ảnh</label>
                    <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror"  name="HinhAnh[]" accept=".jpg, .jpeg, .png" multiple />
                    @error('HinhAnh')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>  
                <div class="mb-3">
                    <label class="form-label" for="dongia">Cấu hình</label>
                    <textarea class="form-control" id="cauhinh" name="cauhinh"  value="{{ old('cauhinh') }}"></textarea>
                    @error('cauhinh')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="motasanpham">Mô tả</label>
                    <textarea class="form-control" id="motasanpham" name="motasanpham"  value="{{ old('motasanpham') }}"></textarea>
                    @error('motasanpham')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>          
                <button type="submit" class="btn btn-primary"> Thêm vào CSDL</button>
            </form>
        </div>
    </div>

<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#motasanpham' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
<script>
    ClassicEditor
    .create( document.querySelector( '#cauhinh' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

@endsection