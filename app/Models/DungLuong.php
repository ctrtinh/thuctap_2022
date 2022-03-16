<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DungLuong extends Model
{
    use HasFactory;
    
    protected $table = 'dungluong';
    protected $fillable = [
		'dungluong', 'dungluong_slug',
	];
    public function SanPham()
    {
        return $this->hasMany(SanPham::class, 'dungluong_id', 'id');
    }
}
