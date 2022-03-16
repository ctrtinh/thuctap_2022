<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BinhLuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach($tieude_slug='')
    {        
        if(empty($tieude_slug))
        {
            $binhluan = BinhLuan::all();

        }
        else
        {
            $baiviet = BaiViet::where('tieude_slug',$tieude_slug)->first();
            $binhluan = BinhLuan::where('baiviet_id',$baiviet->id)->get();
        }
        

        return view('admin.binhluan.danhsach',compact('binhluan'));
    }

    

    public function getOnOffDuyet($id)
    {
        $orm = BinhLuan::find($id);
        $orm->hienthi = 1 - $orm->hienthi; 
        $orm->save();

        $baiviet = BaiViet::find($orm->baiviet_id);

        return redirect()->route('admin.binhluan',$baiviet->tieude_slug);
    }

    public function getThem()
    {
        return view('admin.baiviet.them');
    }

    public function postThem(Request $request)
    {
        

    }

    public function getSua($id)
    {
       
    }

    public function postSua(Request $request, $id)
    {
        

    }

    public function getXoa($id)
    {
        $orm = BinhLuan::find($id);
        $orm->delete();

        $baiviet = BaiViet::find($orm->baiviet_id);

        return redirect()->route('admin.binhluan',$baiviet->tieude_slug)->with('status','Xóa thành công');
    }
}
