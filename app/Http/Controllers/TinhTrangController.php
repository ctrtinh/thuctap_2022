<?php

namespace App\Http\Controllers;

use App\Models\TinhTrang;
use Illuminate\Http\Request;

class TinhTrangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {
        $tinhtrang = TinhTrang::all();
        return view('admin.tinhtrang.danhsach',compact('tinhtrang'));
    }

    public function getThem()
    {
        return view('admin.tinhtrang.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'tinhtrang' => ['required', 'max:255', 'unique:tinhtrang'],
        ],
        $messages = [
            'required' => 'Tên tình trạng không được bỏ trống.',
            'unique' => 'Tên tình trạng đã có trong hệ thống.',
            'max'=> 'Tên tình trạng vượt quá 255 ký tự.'
        ]);

       
        $orm = new TinhTrang();
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();
        
        return redirect()->route('admin.tinhtrang')->with('status', 'Thêm mới thành công');

        //return redirect()->route('admin.tinhtrang');
    }

    public function getSua($id)
    {
        $tinhtrang = TinhTrang::find($id);
        return view('admin.tinhtrang.sua', compact('tinhtrang'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tinhtrang' => ['required', 'max:255', 'unique:tinhtrang,tinhtrang,'.$id],
        ],
        $messages = [
            'required' => 'Tên tình trạng không được bỏ trống.',
            'unique' => 'Tên tình trạng đã có trong hệ thống.',
            'max'=> 'Tên tình trạng vượt quá 255 ký tự.'
        ]);

        $orm = TinhTrang::find($id);
        $orm->tinhtrang = $request->tinhtrang;
        $orm->save();

        return redirect()->route('admin.tinhtrang')->with('status', 'Cập nhật thành công');

    }

    public function getXoa($id)
    {
        $orm = TinhTrang::find($id);
        $orm->delete();

        return redirect()->route('admin.tinhtrang')->with('status', 'Xóa thành công');
    }
}
