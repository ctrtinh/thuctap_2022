@extends('layouts.app')
@section('title', 'Loại Camera')
@section('content')
 <div class="card">
    <div class="card-header">Sửa loại Camera</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.loai.sua',['id' => $loai -> id]) }}" method="post">
        @csrf
        <div class="mb-3">
        <label for="tenloai" class="form-label  @error('tenloai') is-invalid @enderror" value="{{ old('tenloai') }}">Tên loại </label>
            <input type="text" class="form-control" id="tenloai" name="tenloai" value="{{ $loai->tenloai}}">
            @error('tenloai')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    </div>
 </div>
@endsection