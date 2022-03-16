@extends('layouts.app')
@section('title', 'Bài viết')
@section('content')
 <div class="card">
    <div class="card-header">Thêm bài viết</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.baiviet.them') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="chude_id">Thương hiệu</label>
            <select class="form-control @error('chude_id') is-invalid @enderror" name="chude_id" id="chude_id" value="{{ old('chude_id') }}" > 
                <option value="">-- Chọn chủ đề --</option>
                @foreach($chude as $value)
                    <option value="{{ $value->id }}">{{ $value->tenchude }}</option>
                @endforeach
            </select>
            @error('chude_id')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>  
        <div class="mb-3">
            <label for="tieude" class="form-label  @error('tieude') is-invalid @enderror" >Tiêu đề   </label>
            <input type="text" class="form-control" id="tieude" name="tieude" value="{{ old('tieude') }}">
            @error('tieude')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tomtat" class="form-label  @error('tomtat') is-invalid @enderror" >Tóm tắt</label>
            <input type="text" class="form-control" id="tomtat" name="tomta" value="{{ old('tomtat') }}">
            @error('tomtat')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="mb-3" >
            <label for="noidung" class="form-label  @error('noidung') is-invalid @enderror" >Nội dung</label>
            <textarea id="noidung" class="form-control" name="noidung" value="{{ old('noidung') }}"></textarea>
            @error('noidung')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
       

        <button type="submit" class="btn btn-primary">Thêm vào CSDL</button>
    </form>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#noidung' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    </div>
 </div>
@endsection
