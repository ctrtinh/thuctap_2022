<?php

namespace App\Exports;

use App\Models\ThuongHieu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ThuongHieuExport implements FromCollection,WithHeadings,WithMapping
{
    public function headings(): array
    {
        return [
            'tenthuonghieu',
            'tenthuonghieu_slug',
            'hinhanh',
        ];
    }
    public function map($row): array
    {
        return [
            $row->tenthuonghieu,
            $row->tenthuonghieu_slug,
            $row->hinhanh,
        ];
    }
    public function collection()
    {
        return ThuongHieu::all();
    }
}
