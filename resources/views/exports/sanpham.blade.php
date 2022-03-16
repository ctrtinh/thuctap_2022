<table>
    <thead>
    <tr>
       
        <th width="15">Thương hiệu</th>
        <th width="15">Loại</th>
        <th width="15">Dung lượng</th>
        <th width="70">Tên sản phẩm</th>
        <th width="15">Số lượng </th>
        <th width="15">Đơn giá</th>
        <th width="50">Hình ảnh</th>
        <th width="50">Mô tả</th>
    </tr>
    </thead>
    <tbody>
        @foreach($sanpham as $value)
            <tr>
                <td>{{ $value->loai_id }}</td>
                <td>{{ $value->thuonghieu_id }}</td>
                <td>{{ $value->dungluong_id }}</td> 
                <td>{{ $value->tensanpham }}</td>
                <td>{{ $value->soluong }}</td>
                <td>{{ $value->dongia }}</td> 
                @php
                    $chuoi = '';
                    $arr = array();
                @endphp
                @foreach($value->HinhAnh as $chitiet)
                    @php 
                        array_push($arr,$chitiet->hinhanh);  
                    @endphp
                @endforeach
                @php 
                    $chuoi = implode("?", $arr); 
                @endphp
                <td>{{ $chuoi }}</td>
                <td>{{ $value->motasanpham }}</td> 
            </tr>
        @endforeach
    </tbody>
</table>