<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LienHe;
use App\Mail\PhanHoiEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class LienHeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {        
        $lienhe = LienHe::all();
        return view('admin.lienhe.danhsach',compact('lienhe'));
    }


    public function getThem()
    {
       
    }

    public function postThem(Request $request)
    {
      
    }

    public function getPhanHoi($id)
    {
        $lienhe = LienHe::find($id);
        return view('admin.lienhe.phanhoi', compact('lienhe'));
    }

    public function postPhanHoi(Request $request, $id)
    {
        
        $orm =  LienHe::find($id);    
        // $orm->hovaten = $request->hovaten;
        // $orm->email = $request->email;
        // $orm->sodienthoai = $request->sodienthoai;
        // $orm->noidung = $request->noidung;
        $orm->phanhoi = $request->phanhoi;
        $orm->save();
        Mail::to($orm->email)->send(new PhanHoiEmail($orm));

        return redirect()->route('admin.lienhe')->with('status', 'Phản hồi thành công');
        

    }

    public function getXoa($id)
    {
        $orm = LienHe::find($id);
        $orm->delete();


        return redirect()->route('admin.lienhe')->with('status', 'Xóa  thành công');
    }
    
    
}
