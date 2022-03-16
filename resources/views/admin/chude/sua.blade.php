@extends('layouts.app')
@section('title', 'Chủ đề')
@section('content')
 <div class="card">
    <div class="card-header">Sửa chủ đề</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.chude.sua',['id' => $chude -> id]) }}" method="post">
        @csrf
        <div class="mb-3">
        <label for="tenchude" class="form-label  @error('tenchude') is-invalid @enderror" value="{{ old('tenchude') }}">Tên chủ đề   </label>
            <input type="text" class="form-control" id="tenchude" name="tenchude" value="{{ $chude->tenchude }}">
            @error('tenchude')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    </div>
 </div>
@endsection