<?php

namespace App\Http\Controllers;

use App\Models\DungLuong;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DungLuongController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {
        $dungluong = DungLuong::all();
        return view('admin.dungluong.danhsach',compact('dungluong'));
    }

    public function getThem()
    {
        return view('admin.dungluong.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'dungluong' => ['required', 'max:255', 'unique:dungluong'],
        ],
        $messages = [
            'required' => 'Tên dung lượng không được bỏ trống.',
            'unique' => 'Tên dung lượng đã có trong hệ thống.',
            'max' => 'Độ dài tối đa không quá 255 ký tự!',
        ]);
           
        $orm = new DungLuong();
        $orm->dungluong = $request->dungluong;
        $orm->dungluong_slug = Str::slug($request->dungluong, '-');
        $orm->save();
        return redirect()->route('admin.dungluong')->with('status', 'Thêm mới thành công');
    }

    public function getSua($id)
    {
        $dungluong = DungLuong::find($id);
        return view('admin.dungluong.sua', compact('dungluong'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'dungluong' => ['required', 'max:255', 'unique:dungluong,dungluong,'.$id],
        ],
        $messages = [
            'required' => 'Tên dung lượng không được bỏ trống.',
            'unique' => 'Têndung lượng đã có trong hệ thống.',
            'max' => 'Độ dài tối đa không quá 255 ký tự!',
        ]);
           
        $orm = DungLuong::find($id);
        $orm->dungluong = $request->dungluong;
        $orm->dungluong_slug = Str::slug($request->dungluong, '-');
        $orm->save();

        return redirect()->route('admin.dungluong')->with('status', 'Cập nhật thành công');

    }

    public function getXoa($id)
    {
        $orm = DungLuong::find($id);
        $orm->delete();
    
        return redirect()->route('admin.dungluong')->with('status', 'Xóa  thành công');
    }
}
