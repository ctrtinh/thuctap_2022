<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\LienHe;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PhanHoiEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $lienhe;
    
    public function __construct(LienHe $dh)
    {
        $this->lienhe = $dh;
    }
    
    public function build()
    {
        return $this->view('admin.emails.phanhoi')
        ->subject('Phản hồi tại ' . config('app.name', 'CameraStore'));
    }
}
