<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang_ChiTiet extends Model
{
    use HasFactory;
    protected $table = 'donhang_chitiet';
 
    public function DonHang()
    {
        return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
    }
    
    public function SanPham()
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id', 'id');
    }
}
