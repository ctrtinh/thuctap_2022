<?php

namespace App\Imports;

use App\Models\SanPham;
use App\Models\HinhAnh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SanPhamImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /*
        return new SanPham([
            'loai_id' => $row['loai_id'],
            'thuonghieu_id' => $row['thuonghieu_id'],
            'chatlieu_id' => $row['chatlieu_id'],
            'tensanpham' => $row['tensanpham'],
            'tensanpham_slug' => $row['tensanpham_slug'],
            'soluong' => $row['soluong'],
            'dongia' => $row['dongia'],
            'hinhanh' => $row['hinhanh'],
        ]);
        */
        
        $sanpham = SanPham::create([
            'loai_id' => $row['loai'],
            'thuonghieu_id' => $row['thuong_hieu'],
            'dungluong_id' => $row['dung_luong'],
            'tensanpham' => $row['ten_san_pham'],
            'tensanpham_slug' => Str::slug($row['ten_san_pham']),
            'soluong' => $row['so_luong'],
            'dongia' => $row['don_gia'],
        ]);

        $spreadsheet = IOFactory::load(request()->file('file_excel'));
        $i = 0;
        $image = $row['hinh_anh'];      
        $path =  explode("?",$image);
        foreach($path as $hinhanh)
        {
            HinhAnh::create([
                'sanpham_id' => $sanpham->id,
                'hinhanh' => $hinhanh,
            ]);
        }

        return $sanpham;
    }

}
