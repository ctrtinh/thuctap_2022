<table>
    <thead>
    <tr>
        <th  width="50">Họ và tên</th>
        <th  width="50">Địa chỉ Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>