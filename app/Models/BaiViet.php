<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;

    protected $table = 'baiviet';
 
    public function BinhLuan()
    {
        return $this->belongsTo(BinhLuan::class, 'baiviet_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ChuDe()
    {
        return $this->belongsTo(ChuDe::class, 'chude_id', 'id');
    }
}
