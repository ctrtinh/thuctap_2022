@extends('layouts.app')
@section('title', 'Người dùng')

@section('content')
    <div class="card">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        <div class="card-body table-responsive">
            <div class="d-flex mb-2 ">
                <a href="{{ route('admin.nguoidung.them') }}" class="btn btn-info mr-1"><i class="fas fa-plus"></i> Thêm mới</a>
                <form action="{{ route('admin.nguoidung.xuat') }}" method="post">
                @csrf
                    <select class="form-control" name="select" id="select" onchange="if(this.value != 0) { this.form.submit(); }">
                        <option value="">Xuất ra Excel theo</option>
                        <option value="staff">DS nhân viên  </option>
                        <option value="admin">DS quản lý </option>
                        <option value="user">DS khách hàng</option>
                    </select>
                </form>
            </div>
            <table id="table_id" class="table table-bordered table-hover table-sm ">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Họ và tên</th>
                        <th width="20%">Tên đăng nhập</th>
                        <th width="30%">Email</th>
                        <th width="10%">Quyền hạn</th>
                        <th width="5%">Kích hoạt</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nguoidung as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->email }}</td>
                        <td class="text-center">
                            @if($value->role == 'admin')
                                <span class="badge bg-danger">{{ $value->role }}</span>
                            @elseif($value->role == 'staff')
                                <span class="badge bg-warning text-dark">{{ $value->role }}</span>
                            @else
                                <span class="badge bg-info text-dark">{{ $value->role }}</span>

                            @endif
                        </td>
                        <td class="text-center">
                                @if($value->kichhoat == 0)
                                    <a href="{{ route('admin.nguoidung.kichhoat', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                                @else
                                    <a href="{{ route('admin.nguoidung.kichhoat', ['id' => $value->id]) }}"><i class="fas fa-ban text-danger"></i></a>           
                                @endif
                            </td>
                        <td class="text-center"><a href="{{ route('admin.nguoidung.sua', ['id' => $value->id]) }}"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.nguoidung.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa người dùng {{ $value->name}} không?')"><i class="fas fa-trash-alt text-danger"></i></a></td>
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