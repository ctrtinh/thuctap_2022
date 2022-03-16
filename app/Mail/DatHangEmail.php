<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\DonHang;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DatHangEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $donhang;
    
    public function __construct(DonHang $dh)
    {
        $this->donhang = $dh;
    }
    
    public function build()
    {
        return $this->view('admin.emails.dathang')
        ->subject('Đặt hàng thành công tại ' . config('app.name', 'CameraStore'));
    }
}
