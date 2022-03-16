@extends('layouts.app')
@section('title', 'Tình trạng')
@section('content')
 <div class="card">
    <div class="card-header">Thêm tình trạng</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.tinhtrang.them') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="tinhtrang" class="form-label  @error('tinhtrang') is-invalid @enderror" value="{{ old('tinhtrang') }}">Tình trạng  </label>
            <input type="text" class="form-control" id="tinhtrang" name="tinhtrang">
            @error('tinhtrang')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm vào CSDL</button>
    </form>
    </div>
 </div>
@endsection