<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\DonHang_ChiTiet;
use App\Models\TinhTrang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DonHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDanhSach()
    {
        $donhang = DonHang::orderBy('created_at', 'desc')->get();
        return view('admin.donhang.danhsach', compact('donhang'));
    }

    public function getDanhSachNgay()
    {
        $date = Carbon::today();//lay ngay hien tai
        $donhang = DonHang::whereBetween('donhang.created_at', [$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
                    ->orderBy('created_at', 'desc')->get();
        return view('admin.donhang.danhsach', compact('donhang'));
    }

    public function getDanhSachDonHangMoi()
    {
        $donhang = DonHang::where('tinhtrang_id', '1')->orderBy('created_at', 'desc')->get();
        return view('admin.donhang.moi', compact('donhang'));
    }
    
    public function getThem()
    {
    }
    
    public function postThem(Request $request)
    {   
    }
    
    public function getSua($id)
    {
        $donhang = DonHang::find($id);
        return view('admin.donhang.sua', compact('donhang'));
    }
    
    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'dienthoai' => ['required', 'max:20'],
            'diachi' => ['required', 'max:255'],
            'tinhtrang' => ['required'],
        ]);
            
        $orm = DonHang::find($id);
        $orm->dienthoaigiaohang = $request->dienthoai;
        $orm->diachigiaohang = $request->diachi;
        $orm->tinhtrang_id = $request->tinhtrang;
        $orm->save();
        
        return redirect()->route('admin.donhang');
        
    }
    
    public function getXoa($id)
    {
        $orm = DonHang::find($id);
        
        $chitiet = DonHang_ChiTiet::where('donhang_id', $orm->id)->get();
        foreach($chitiet as $value)
        {
            $value->delete();
        }

        $orm->delete();

        return redirect()->route('admin.donhang');
    }

    public function postTrangThai(Request $request, $id)
    {
        $orm = DonHang::find($id);
        
            if($request->select == 10 || $request->select1 == 10 )
            {
                $orm->tinhtrang_id = 10;
                $orm->save();

            }
            elseif($request->select == 9 || $request->select1 == 9) 
            {
                $orm->tinhtrang_id = 9;
                $orm->save();
            }
            elseif($request->select == 8 || $request->select1 == 8) 
            {
                $orm->tinhtrang_id = 8;
                $orm->save();
            }
            elseif($request->select == 7 || $request->select1 == 7) 
            {
                $orm->tinhtrang_id = 7;
                $orm->save();       
            }
            elseif($request->select == 6 || $request->select1 == 6) 
            {
                $orm->tinhtrang_id = 6;
                $orm->save();     
            }
            elseif($request->select == 5 || $request->select1 == 5)  
            {
                $orm->tinhtrang_id = 5;
                $orm->save();  
            }
            elseif($request->select == 4 || $request->select1 == 4) 
            {
                $orm->tinhtrang_id = 4;
                $orm->save();      
            }
            elseif($request->select == 3 || $request->select1 == 3) 
            {
                $orm->tinhtrang_id = 3;
                $orm->save();       
            }
            elseif($request->select == 2 || $request->select1 == 2) 
            {
                $orm->tinhtrang_id = 2;
                $orm->save();
            }
            else
            {
                $orm->tinhtrang_id = 1;
                $orm->save();
            }
        
            if($request->select1)
                return redirect()->route('admin.donhang.moi');
            else        
                return redirect()->route('admin.donhang');
    }
    
    public function getDoanhThu(Request $request)
    {
        if($request->dateStart != '' && $request->dateEnd != '')
        {
            $doanhthu = DonHang_ChiTiet::leftJoin('donhang', 'donhang.id', '=', 'donhang_chitiet.donhang_id')
            ->leftJoin('sanpham', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                      DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban')
                    )
            ->where([
                //['donhang.created_at', '>=', $request->dateStart],
                //['donhang.created_at', '<=', $request->dateEnd],
                ['donhang.tinhtrang_id',10]
            ])
            ->whereBetween('donhang.created_at', [ Carbon::parse($request->dateStart)->format('Y-m-d')." 00:00:00", Carbon::parse($request->dateEnd)->format('Y-m-d')." 23:59:59"])
            ->groupBy('sanpham.id')
            ->get();
     
            $session_title_dateStart = $request->dateStart;
            $session_title_dateEnd = $request->dateEnd;
            
            return view('admin.donhang.doanhthu',compact('doanhthu','session_title_dateStart','session_title_dateEnd'));  
        }
        return view('admin.donhang.doanhthu');  

    }
    
}
