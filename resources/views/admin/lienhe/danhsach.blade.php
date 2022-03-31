@extends('layouts.app')
@section('title', 'Liên hệ')
@section('content')
<div class="card">
    <div class="card-body table-responsive">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
       
        <table id="table_id" class="table table-bordered table-hover table-sm ">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="15%">Họ tên</th>
                    <th width="15%">Email</th>
                    <th width="15%">Số điện thoại</th>
                    <th width="25%">Nội dung</th>
                    <th width="20%">Nội dung phản hồi</th>
                    <th width="5%">Phản hồi</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lienhe as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->hovaten }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->sodienthoai }}</td>
                        <td>{{ $value->noidung }}</td>
                        <td>{{ $value->phanhoi }}</td>
                        <td class="text-center"><a href="{{ route('admin.lienhe.phanhoi', ['id' => $value->id]) }}"><i class="fas fa-comment"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.lienhe.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa loại {{ $value->email}} không?')"><i class="fas fa-trash-alt text-danger"></i></a></td>
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