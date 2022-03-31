@extends('layouts.app')
@section('title', 'Phản hồi')
@section('content')
 <div class="card">
    <div class="card-header">Phản hồi</div>
    <div class="card-body table-responsive">
    <form action="{{ route('admin.lienhe.phanhoi',['id' => $lienhe -> id]) }}" method="post">
        @csrf
        <div class="mb-3">
         <label for="phanhoi" class="form-label  " value="{{ old('phanhoi') }}">Phản hồi </label>
            <input type="text" class="form-control" id="phanhoi" name="phanhoi" value="{{ $lienhe->phanhoi}}">
            @error('phanhoi')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Phản hồi</button>
    </form>
    </div>
 </div>
@endsection