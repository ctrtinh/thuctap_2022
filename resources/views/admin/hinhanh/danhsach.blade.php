@extends('layouts.app')
@section('title', 'Hình ảnh')
@section('content')
 <div class="card">
        <div class="card-body table-responsive">
        <p><a href="{{ route('admin.hinhanh.them',['tensanpham_slug' => $sanpham->tensanpham_slug]) }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm mới</a></p>
        <table id="table_id" class="table table-bordered table-hover table-sm ">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="75%">Hình ảnh</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hinhanh as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center"><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" width="300" /></td>                   
                        <td class="text-center"><a href="{{ route('admin.hinhanh.sua', ['id' => $value->id]) }}"><i class="fa fa-edit"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.hinhanh.xoa', ['id' => $value->id]) }}"><i class="fa fa-trash-alt text-danger"></i></a></td>
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