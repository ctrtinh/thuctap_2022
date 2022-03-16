@extends('layouts.app')
@section('title', 'Bài viết')
@section('content')
 <div class="card">
    <div class="card-header">Sửa bài viết</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.baiviet.sua',['id' => $baiviet -> id]) }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="chude_id">Chủ đề</label>
            <select class="form-control @error('chude_id') is-invalid @enderror" name="chude_id" id="chude_id" require> 
                <option value="">-- Chọn chủ đề --</option>
                @foreach($chude as $value)
                    <option value="{{ $value->id }}" {{ $baiviet->chude_id == $value->id ? 'selected' : '' }}>{{ $value->tenchude}}</option>
                @endforeach
            </select>
            @error('chude_id')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>  
        <div class="mb-3">
            <label for="tieude" class="form-label  @error('tieude') is-invalid @enderror" value="{{ old('tieude') }}">Tiêu đề   </label>
            <input type="text" class="form-control" id="tieude" name="tieude" value="{{ $baiviet ->tieude }}">
            @error('tieude')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tomtat" class="form-label  @error('tomtat') is-invalid @enderror" value="{{ old('tomtat') }}">Tóm tắt</label>
            <input type="text" class="form-control" id="tomtat" name="tomtat" value="{{ $baiviet ->tomtat }}">
            @error('tomtat')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <div class="mb-3" >
            <label for="noidung" class="form-label  @error('noidung') is-invalid @enderror" value="{{ old('noidung') }}">Nội dung</label>
            <textarea id="noidung" class="form-control" name="noidung"  value="{{ $baiviet ->noidung }}">{{ $baiviet ->noidung }}</textarea>
            @error('noidung')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
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