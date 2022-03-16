@extends('layouts.app')
@section('title', 'Bài viết')
@section('content')
 <div class="card">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        <div class="card-body table-responsive">
        <p><a href="{{ route('admin.baiviet.them') }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm mới</a></p>
        @if(Auth::user()->role == 'admin')
            <table id="table_id" class="table table-bordered table-hover table-sm ">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Tiêu đề</th>
                        <th width="15%">Người viết</th>
                        <th width="7%">Lượt xem </th>
                        <th width="10%">Kiểm duyệt </th>
                        <th width="7%">Hiển thị </th>
                        <th width="7%">Trạng thái bình luận</th>
                        <th width="7%">Bình luận</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($baiviet as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->tieude }}</td>
                            <td>{{ $value->User->name }}</td>
                            <td>{{ $value->luotxem }}</td>
                            <td class="text-center">
                                @if($value->kiemduyet == 1)
                                    <a href="{{ route('admin.baiviet.OnOffDuyet', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                                @else
                                    <a href="{{ route('admin.baiviet.OnOffDuyet', ['id' => $value->id]) }}"><i class="fas fa-ban text-danger"></i></a>           
                                @endif
                            </td>
                            <td class="text-center">
                                @if($value->hienthi == 1)
                                    <a href="{{ route('admin.baiviet.OnOffHienThi', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                                @else
                                    <a href="{{ route('admin.baiviet.OnOffHienThi', ['id' => $value->id]) }}"><i class="fas fa-ban text-danger"></i></a>           
                                @endif
                            </td>
                            <td class="text-center">
                                @if($value->binhluan == 1)
                                    <a href="{{ route('admin.baiviet.OnOffBinhLuan', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                                @else
                                    <a href="{{ route('admin.baiviet.OnOffBinhLuan', ['id' => $value->id]) }}"><i class="fas fa-ban text-danger"></i></a>           
                                @endif
                            </td>
                            <td class="text-center">    
                                <a href="{{ route('admin.binhluan', ['tieude_slug' => $value->tieude_slug]) }}"><i class="fas fa-comments"></i></a>
                            </td>
                            <td class="text-center"><a href="{{ route('admin.baiviet.sua', ['id' => $value->id]) }}"><i class="fa fa-edit"></i></a></td>                            

                            <td class="text-center"><a href="{{ route('admin.baiviet.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa bài viết {{ $value->tieude}} không?')"><i class="fa fa-trash-alt text-danger"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <table id="table_id" class="table table-bordered table-hover table-sm ">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Tiêu đề</th>
                        <th width="15%">Người viết</th>
                        <th width="7%">Lượt xem </th>                      
                        <th width="7%">Bình luận</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($baiviet as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->tieude }}</td>
                            <td>{{ $value->User->name }}</td>
                            <td>{{ $value->luotxem }}</td>
                            
                            <td class="text-center">    
                                <a href="{{ route('admin.binhluan', ['tieude_slug' => $value->tieude_slug]) }}"><i class="fas fa-comments"></i></a>
                            
                            </td>
                            <td class="text-center"><a href="{{ route('admin.baiviet.sua', ['id' => $value->id]) }}"><i class="fas fa-edit"></i></a></td>                            
                            <td class="text-center"><a href="{{ route('admin.baiviet.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa bài viết {{ $value->tieude}} không?')"><i class="fas fa-trash-alt text-danger"></i></a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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