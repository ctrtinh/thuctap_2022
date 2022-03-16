<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BaiViet;
use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Exports\NguoiDungExport;
use Excel;
use Auth;

class NguoiDungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Nhập từ Excel
    // public function postNhap(Request $request)
    // {
       
    // }
    
    // Xuất ra Excel
    public function postXuat(Request $request)
    {
        /*
            (new InvoicesExport)->queue('invoices.xlsx');
            return back()->withSuccess('Export started!');
        */

        if($request->select == 'staff') // Mua nhiều nhất
        {
            return (new NguoiDungExport)->Role('staff')->download('danh-sach-nhan-vien.xlsx');

        }
        elseif($request->select == 'admin') // Mới nhất
        {
            return (new NguoiDungExport)->Role('admin')->download('danh-sach-quan-ly.xlsx');
        }
        else
        {
            return (new NguoiDungExport)->Role('user')->download('danh-sach-khach-hang.xlsx');
        }


    }
    
    public function getDanhSach()
    {
        $nguoidung = User::all();
        return view('admin.nguoidung.danhsach', compact('nguoidung'));
    }
    
    public function getThem()
    {
        return view('admin.nguoidung.them');
    }
    
    public function postThem(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'],
        ],
        $messages = [
            'name.required' => 'Họ và tên không được bỏ trống.',
            'email.required' => 'Địa chỉ email không được bỏ trống.',
            'role.required' => 'Chưa chọn quyền hạn.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.confirmed' => 'Xác nhân mật khẩu không được bỏ trống.',
            'password.min' => 'Mật khẩu tối đa 4 ký tự.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',

        ]);
        
        $orm = new User();
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->password = Hash::make($request->password);
        $orm->role = $request->role;
        $orm->save();
        
        return redirect()->route('admin.nguoidung')->with('status', 'Thêm mới thành công');
    }
    
    public function getSua($id)
    {
        $nguoidung = User::find($id);
        return view('admin.nguoidung.sua', compact('nguoidung'));
    }
    
    public function postSua(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'role' => ['required'],
            'password' => ['confirmed'],
        ],
        $messages = [
            'name.required' => 'Họ và tên không được bỏ trống.',
            'email.required' => 'Địa chỉ email không được bỏ trống.',
            'role.required' => 'Chưa chọn quyền hạn.',
            'password.required' => 'Mật khẩu không được bỏ trống.',
            'password.confirmed' => 'Xác nhân mật khẩu không được bỏ trống.',
            'password.min' => 'Mật khẩu tối đa 4 ký tự.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',
        ]);
        
        $orm = User::find($request->id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->role = $request->role;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        
        return redirect()->route('admin.nguoidung')->with('status', 'Cập nhật thành công');
    }
    
    public function getXoa($id)
    {
        $orm = User::find($id);
        $orm->delete();
        
        return redirect()->route('admin.nguoidung')->with('status', 'Xóa thành công');;
    }

    public function getInfo()
    {
        $baiviet = BaiViet::where('user_id',Auth::user()->id)->get();
        
        foreach($baiviet as $value)
        {
            $binhluan = BinhLuan::where('baiviet_id', $value->id)->get();
        }

        if(!empty($binhluan))
            return view('admin.nguoidung.info',compact('baiviet','binhluan'));
        else
            return view('admin.nguoidung.info',compact('baiviet'));

    }

    public function postSuaInfo(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'password' => ['confirmed'],
        ]);
        
        $orm = User::find($request->id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        if(!empty($request->password)) $orm->password = Hash::make($request->password);
        $orm->save();
        
        return redirect()->route('admin.nguoidung.info',Auth::user()->name)->with('status', 'Cập nhật  thành công');
    }

}
