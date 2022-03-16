<?php

namespace App\Http\Controllers;

use App\Models\DonHang_ChiTiet;
use Illuminate\Http\Request;

class DonHangChiTietController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach($id)
    {
        $donhang_chitiet = DonHang_ChiTiet::where('donhang_id',$id)->get();
        
        return view('admin.donhang.chitiet', compact('donhang_chitiet'));
    }
    
    public function getThem()
    {
    }
    
    public function postThem(Request $request)
    {
       
    }
    
    public function getSua($id)
    {
        $donhang_chitiet = DonHang_ChiTiet::find($id);
        return view('admin.donhang.chitiet_sua', compact('donhang_chitiet'));
    }
    
    public function postSua(Request $request, $id)
    {
       
        $this->validate($request, [
            'tensanpham' => [ 'max:255'],
            'soluongban' => ['required', 'numeric'],
            'dongiaban' => ['required', 'numeric'],        
        ]);

        $orm = DonHang_ChiTiet::find($id);
        $orm->donhang_id = $orm->donhang_id;
        $orm->sanpham_id = $orm->sanpham_id;
        $orm->soluongban = $request->soluongban;
        $orm->dongiaban = $request->dongiaban;
        $orm->save();
     
        var_dump( $orm->donhang_id);

        return redirect()->route('admin.donhang.chitiet',['id' => $orm->donhang_id]);
    }
    
    public function getXoa($id)
    {
        $orm = DonHang_ChiTiet::find($id);
        $orm->delete();

        return redirect()->route('admin.donhang.chitiet',$id);
    }
}
