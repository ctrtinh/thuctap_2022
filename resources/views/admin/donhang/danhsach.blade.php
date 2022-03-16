@extends('layouts.app')
@section('title', 'Đơn hàng')
@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <table id="table_id" class="table table-bordered table-hover table-sm ">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Khách hàng</th>
                        <th width="45%">Thông tin giao hàng</th>
                        <th width="15%">Ngày đặt</th>
                        <th width="8%">Tình trạng</th>
                        <th width="7%">Chi tiết</th>
                        <th width="4%">Sửa</th>
                        <th width="4%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donhang as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->User->name }}</td>
                        <td>
                            <span class="d-block">Điện thoại: <strong>{{ $value->dienthoaigiaohang }}</strong></span>
                            <span class="d-block">Địa chỉ giao: <strong>{{ $value->diachigiaohang }}</strong></span>
                            <span class="d-block">Ghi chú  : <strong>{{ $value->chitietgiaohang }}</strong></span>
                            <span class="d-block">Sản phẩm:</span>
                            <table class="table table-bordered table-hover table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Sản phẩm</th>
                                        <th width="5%">SL</th>
                                        <th width="15%">Đơn giá</th>
                                        <th width="20%">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $tongtien = 0; @endphp
                                    @foreach($value->DonHang_ChiTiet as $chitiet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $chitiet->SanPham->tensanpham }}</td>
                                        <td>{{ $chitiet->soluongban }}</td>
                                        <td class="text-end">{{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                        <td class="text-end">{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                    </tr>
                                    @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="4">Tổng tiền sản phẩm:</td>
                                        <td class="text-end"><strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>
                            <form action="{{ route('admin.donhang.trangthai', ['id' =>$value->id]) }}" method="post">
                            @csrf
                                <div class="select-itms">
                                    <select name="select" id="select1" onchange="if(this.value != 0) { this.form.submit(); }">
                                        @if($value->tinhtrang_id == 1)
                                            <option value="1" selected> Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 2)
                                            <option value="1" > Mới</option>
                                            <option value="2" selected>Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 3)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" selected>Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 4)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" selected>Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 5)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" selected>Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 6)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" selected>Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 7)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" selected>Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 8)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" selected>Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 9)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" selected>Đã chuyển hoàn</option>
                                            <option value="10">Thành công</option>
                                        @elseif($value->tinhtrang_id == 10)
                                            <option value="1" > Mới</option>
                                            <option value="2" >Đang xác nhận / Đã xác nhận</option>
                                            <option value="3" >Đã hủy</option>
                                            <option value="4" >Đang đóng gói sản phẩm</option>
                                            <option value="5" >Chờ đi nhận / Đang đi nhận / Đã nhận hàng </option>
                                            <option value="6" >Đang chuyển</option>
                                            <option value="7" >Thất bại </option>
                                            <option value="8" >Đang chuyển hoàn</option>
                                            <option value="9" >Đã chuyển hoàn</option>
                                            <option value="10" selected>Thành công</option>        
                                        @endif
                                    </select>
                                </div>
                            </form>                           
                        </td>
                        <td class="text-center"><a href="{{ route('admin.donhang.chitiet', ['id' => $value->id]) }}"><i class="fas fa-info"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.donhang.sua', ['id' => $value->id]) }}"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center"><a href="{{ route('admin.donhang.xoa', ['id' => $value->id]) }}"><i class="fas fa-trash-alt text-danger"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection