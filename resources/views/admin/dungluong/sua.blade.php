@extends('layouts.app')
@section('title', 'Sửa dung lượng camera')
@section('content')
 <div class="card">
    <div class="card-header">Sửa dung lượng camera</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.dungluong.sua',['id' => $dungluong -> id]) }}" method="post">
        @csrf
        <div class="mb-3">
        <label for="dungluong" class="form-label  @error('dungluong') is-invalid @enderror" value="{{ old('dungluong') }}">Dung lượng </label>
            <input type="text" class="form-control" id="dungluong" name="dungluong" value="{{ $dungluong->dungluong}}">
            @error('dungluong')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    </div>
 </div>
@endsection