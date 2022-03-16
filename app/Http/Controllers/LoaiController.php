<?php

namespace App\Http\Controllers;

use App\Models\Loai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {
        $loai = Loai::all();
        return view('admin.loai.danhsach',compact('loai'));
    }

    public function getThem()
    {
        return view('admin.loai.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'tenloai' => ['required', 'max:255', 'unique:loai'],
        ],
        $messages = [
            'required' => 'Tên loại không được bỏ trống.',
            'unique' => 'Tên loại đã có trong hệ thống.',
            'max' => 'Độ dài tối đa không quá 255 ký tự!',
        ]);
           
        $orm = new Loai();
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();
        return redirect()->route('admin.loai')->with('status', 'Thêm mới thành công');
    }

    public function getSua($id)
    {
        $loai = Loai::find($id);
        return view('admin.loai.sua', compact('loai'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tenloai' => ['required', 'max:255', 'unique:loai,tenloai,'.$id],
        ],
        $messages = [
            'required' => 'Tên loại không được bỏ trống.',
            'unique' => 'Tên loại đã có trong hệ thống.',
            'max' => 'Độ dài tối đa không quá 255 ký tự!',
        ]);
           
        $orm = Loai::find($id);
        $orm->tenloai = $request->tenloai;
        $orm->tenloai_slug = Str::slug($request->tenloai, '-');
        $orm->save();

        return redirect()->route('admin.loai')->with('status', 'Cập nhật thành công');

    }

    public function getXoa($id)
    {
        $orm = Loai::find($id);
        $orm->delete();
    
        return redirect()->route('admin.loai')->with('status', 'Xóa  thành công');
    }

}
