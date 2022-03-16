@extends('layouts.app')
@section('title', 'Bình luận ')
@section('content')
 <div class="card">
        @if (session('status'))
            <div id="AlertBox" class="alert alert-success hide" role="alert">
                {!! session('status') !!}
            </div>
        @endif
        <div class="card-body table-responsive">
        <table id="table_id" class="table table-bordered table-hover table-sm ">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="30%">Nội dung</th>
                    <th width="15%">Người bình luận</th>
                    <th width="7%">Hiển thị </th>   
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($binhluan as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->noidung }}</td>
                        <td>{{ $value->user->name }}</td>    
                        <td class="text-center">
                            @if($value->hienthi == 1)
                                <a href="{{ route('admin.binhluan.OnOffDuyet', ['id' => $value->id]) }}"><i class="fas fa-check-circle"></i></a>
                            @else
                                <a href="{{ route('admin.binhluan.OnOffDuyet', ['id' => $value->id]) }}"><i class="fas fa-ban"></i></a>           
                            @endif
                        </td>                        
                        <td class="text-center"><a href="{{ route('admin.binhluan.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa bình luận {{ $value->noidung}} không?')"><i class="fa fa-trash-alt text-danger"></i></a></td>
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