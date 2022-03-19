<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';

    protected $fillable = [
        'loai_id',
        'thuonghieu_id',
        'dungluong_id',
        'tensanpham',
        'tensanpham_slug',
        'dungluong',
        'soluong',
        'dongia',
        'hinhanh',
        'cauhinh',
        'motasanpham',
    ];
 
    public function Loai()
    {
        return $this->belongsTo(Loai::class, 'loai_id', 'id');
    }
    
    public function ThuongHieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'thuonghieu_id', 'id');
    }

    public function DungLuong()
    {
        return $this->belongsTo(DungLuong::class, 'dungluong_id', 'id');
    }

    public function HinhAnh()
    {
        return $this->hasMany(HinhAnh::class, 'sanpham_id', 'id');
    }

    public function DonHang_ChiTiet()
    {
        return $this->hasMany(DonHang_ChiTiet::class, 'sanpham_id', 'id');
    }
    public function SanPhamYeuThich()
    {
        return $this->hasMany(SanPhamYeuThich::class, 'sanpham_id', 'id');
    }

}
