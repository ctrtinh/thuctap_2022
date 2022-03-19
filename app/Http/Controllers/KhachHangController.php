<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DonHang;
use App\Models\SanPhamYeuThich;
use App\Models\SanPham;
use App\Models\DonHang_ChiTiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KhachHangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function getHome()
    {
        return view('khachhang.index');
    }
    
    public function getDonHangHuy($id)
    {
        $orm = DonHang::find($id);
        $orm->tinhtrang_id = 3 ;
        $orm->save();

        $donhang = DonHang::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('khachhang.donhang',compact('donhang'));
    }

    public function getDonHang()
    {
        $donhang = DonHang::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('khachhang.donhang',compact('donhang'));
    }
    
    public function getDonHang_ChiTiet($id)
    {
        $donhang = DonHang_ChiTiet::where('donhang_id',$id)->get();
        return view('khachhang.donhang_chitiet',compact('donhang'));
    }
    
    public function postDonHang(Request $request, $id)
    {
        return redirect()->route('khachhang.donhang');
    }

    public function getHoSo()
    {
        return view('khachhang.hoso');
    }

    public function postHoSo(Request $request)
    {
        $id = Auth::user()->id;
        
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['confirmed'],
        ]);
        
        $orm = User::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        
        return redirect()->route('khachhang.hoso');       
    }

    
    public function getSanPhamYeuThich()
    {
        if(SanPhamYeuThich::count() <= 0)
            return view('khachhang.sanphamyeuthich_rong');
        else
            
        $danhsach = SanPhamYeuThich::join('sanpham', 'sanpham.id', '=', 'sanphamyeuthich.sanpham_id')
            ->select('sanphamyeuthich.*',
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
            ->get();
        //dd($danhsach);
        return view('khachhang.sanphamyeuthich',compact('danhsach'));
    }
    public function getXoaSanPhamYeuThich($id)
    {
        $orm = SanPhamYeuThich::find($id);
        $orm->delete();

        $sanpham = SanPham::find($orm->sanpham_id);

        return redirect()->route('khachhang.danhsachsanpham',$sanpham->tensanpham_slug)->with('status','Xóa thành công');
    }

    public function getThemSanPhamYeuThich ($tensanpham_slug)
    {
        $sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();

        $sanphamyeuthich = SanPhamYeuThich::where('sanpham_id',$sanpham->id)->first();

        if(empty($sanphamyeuthich))
        {
            $orm = new SanPhamYeuThich();
            $orm->sanpham_id = $sanpham->id;
            $orm->user_id = Auth::user()->id;
            $orm->save();
            return redirect()->back()->with('status', 'Đã thêm sản phẩm vào danh sách yêu thích!');
        }
        else
        {
            return redirect()->back()->with('status', 'Sản phẩm đã tồn tại trong danh sách yêu thích!');
        }
    }
    
}
