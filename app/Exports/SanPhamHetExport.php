<?php

namespace App\Exports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SanPhamHetExport implements FromView
{
    public function view(): View
    {
        return view('exports.sanphamhet', [
            'sanpham' => SanPham::query()->where('soluong',0 )->get() 
        ]);
    }
}
