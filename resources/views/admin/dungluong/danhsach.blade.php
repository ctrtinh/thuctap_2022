@extends('layouts.app')
@section('title', 'Dung lượng camera')
@section('content')
<div class="card">
    <div class="card-body table-responsive">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        <p><a href="{{ route('admin.dungluong.them') }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm mới</a></p>
        <table id="table_id" class="table table-bordered table-hover table-sm ">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="45%">Dung lượng</th>
                    <th width="40%">Dung lượng không dấu</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dungluong as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->dungluong }}</td>
                        <td>{{ $value->dungluong_slug }}</td>
                        <td class="text-center"><a href="{{ route('admin.dungluong.sua', ['id' => $value->id]) }}"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.dungluong.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa loại {{ $value->dungluong}} không?')"><i class="fas fa-trash-alt text-danger"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $('#AlertBox').removeClass('hide');
        $('#AlertBox').delay(2000).slideUp(500);
    });
</script>
@endsection