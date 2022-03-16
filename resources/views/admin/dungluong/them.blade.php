@extends('layouts.app')
@section('title', 'Dung lượng camera')
@section('content')
 <div class="card">
    <div class="card-header">Thêm dung lượng camera</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.dungluong.them') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="dungluong" class="form-label  @error('dungluong') is-invalid @enderror" value="{{ old('dungluong') }}">Dung lượng </label>
            <input type="text" class="form-control" id="dungluong" name="dungluong">
            @error('dungluong')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm vào CSDL</button>
    </form>
    </div>
 </div>
@endsection