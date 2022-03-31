<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\User;
use App\Models\SanPham;
use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\DonHang_ChiTiet;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function getHome()
    {

        if(Auth::user()->kichhoat == 0)
		{
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
            {
                $donhang = DonHang::where('tinhtrang_id',1)->get();
                $user = User::all();
                $sanpham = SanPham::where('soluong',0)->get();
                $date = Carbon::today();//lay ngay hien tai
    
                $doanhthu = DonHang_ChiTiet::leftJoin('donhang', 'donhang.id', '=', 'donhang_chitiet.donhang_id')
                    ->leftJoin('sanpham', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
                    ->select('sanpham.*',
                            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                            DB::raw('(select donhang_chitiet.dongiaban from donhang_chitiet limit 1) as dongiaban')
                            )
                    ->whereBetween('donhang.created_at', [$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
                    ->where('donhang.tinhtrang_id',10)
                    ->groupBy('sanpham.id')
                    ->get();
    
                $binhluan = BinhLuan::all();
                return view('admin.index',compact('donhang','user','sanpham','doanhthu','binhluan'));
            }       
            else
                return view('errors.404');
		}
		elseif(Auth::user()->kichhoat == 1)
		{
			Auth::logout();
			return redirect()->route('login')->with('success','Tài Khoản Đã Bị Khóa');
		}

       
    }
    public function getForbidden()
	{
		return view('errors.403');
	}

}
