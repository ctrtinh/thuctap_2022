<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loai extends Model
{
    use HasFactory;
    
    protected $table = 'loai';
    protected $fillable = [
		'tenloai', 'tenloai_slug',
	];
    public function SanPham()
    {
        return $this->hasMany(SanPham::class, 'loai_id', 'id');
    }
}
