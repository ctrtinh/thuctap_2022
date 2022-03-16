<table>
    <thead>
    <tr>
        <th width="50">Tên sản phẩm</th>
        <th width="50">Tên sản phẩm không dấu</th>
        <th width="50">Đơn giá</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sanpham as $value)
        <tr>
            <td>{{ $value->tensanpham }}</td>
            <td>{{ $value->tensanpham_slug }}</td>
            <td>{{ $value->dongia }}</td>

        </tr>
    @endforeach
    </tbody>
</table>