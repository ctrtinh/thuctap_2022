@extends('layouts.app')
@section('title', 'Sản phẩm')

@section('content')
    <div class="card">
        <div class="card-header">Sửa camera  </div>
        <div class="card-body">
            <form action="{{ route('admin.sanpham.sua', ['id' => $sanpham->id]) }}" method="post" enctype="multipart/form-data">
                @csrf          
                <div class="mb-3">
                    <label class="form-label" for="thuonghieu_id">Thương hiệu</label>
                    <select class="form-control @error('thuonghieu_id') is-invalid @enderror" name="thuonghieu_id" id="thuonghieu_id" require> 
                        <option value="">-- Chọn thương hiệu --</option>
                        @foreach($thuonghieu as $value)
                            <option value="{{ $value->id }}" {{ $sanpham->thuonghieu_id == $value->id ? 'selected' : '' }}>{{ $value->tenthuonghieu}}</option>
                        @endforeach
                    </select>
                    @error('thuonghieu_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>    
                <div class="mb-3">
                    <label class="form-label" for="loai_id">Loại </label>
                    <select class="form-control @error('loai_id') is-invalid @enderror" name="loai_id" id="loai_id" require> 
                        <option value="">-- Chọn loại --</option>
                        @foreach($loai as $value)
                            <option value="{{ $value -> id}}" {{ $sanpham->loai_id == $value->id ? 'selected':'' }}>{{ $value -> tenloai}}</option>
                        @endforeach
                    </select>
                    @error('loai_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div> 
                
                <div class="mb-3">
                    <label class="form-label" for="tensanpham">Tên sản phẩm</label>
                    <input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham" name="tensanpham" value="{{$sanpham->tensanpham}}"  required />
                    @error('tensanpham')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>  
                
                <div class="mb-3">
                    <label class="form-label" for="soluong">Số lượng</label>
                    <input type="number" class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong" value="{{$sanpham->soluong}}" required />
                    @error('soluong')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>  
                <div class="mb-3">
                    <label class="form-label" for="tendungluong">Dung lượng</label>
                    <input type="number" class="form-control " id="tendungluong" name="tendungluong" value="{{$sanpham->tendungluong}}"  />
                  
                </div> 
                <div class="mb-3">
                    <label class="form-label" for="dongia">Đơn giá</label>
                    <input type="dongia" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{$sanpham->dongia}}" required />
                    @error('tenchatlieu')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div> 
                
                <div class="mb-3">
                    <label class="form-label" for="HinhAnh">Hình ảnh </label>
                    @if(!empty($img->hinhanh))
                        <div class=" d-flex flex-nowrap justify-content-center" >
                            @foreach($hinhanh as $img) 
                                <img  src="{{ env('APP_URL') . '/storage/app/' . $img->hinhanh }}" width="150"/>
                            @endforeach
                        </div>

                        <span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
                    @endif
                    <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror" id="HinhAnh" name="HinhAnh[]" multiple/>
                    @error('HinhAnh')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div> 
                <div class="mb-3">
                    <label for="cauhinh" class="form-label  @error('cauhinh') is-invalid @enderror" value="{{ old('cauhinh') }}">Cấu hình</label>
                    <textarea class="form-control" id="cauhinh" name="cauhinh"  value="{{$sanpham->cauhinh }}">{{ $sanpham ->cauhinh }}</textarea>
                    @error('cauhinh')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>  
                <div class="mb-3">
                    <label class="form-label" for="motasanpham">Mô tả</label>
                    <textarea class="form-control" id="motasanpham" name="motasanpham"  value="{{$sanpham->motasanpham }}">{{ $sanpham ->motasanpham }}</textarea>
                    @error('motasanpham')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>          
                <button type="submit" class="btn btn-primary"> Cập nhật</button>
            </form>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
@endsection