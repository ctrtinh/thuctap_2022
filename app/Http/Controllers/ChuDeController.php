<?php

namespace App\Http\Controllers;

use App\Models\ChuDe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChuDeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {
        $chude = ChuDe::all();
        return view('admin.chude.danhsach',compact('chude'));
    }

    public function getThem()
    {
        return view('admin.chude.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'tenchude' => ['required', 'max:255', 'unique:chude'],
        ], 
        $messages = [
            'required' => 'Tên chủ đề không được bỏ trống.',
            'unique' => 'Tên chủ đề đã có trong hệ thống.',
        ]);
           
        $orm = new ChuDe();
        $orm->tenchude = $request->tenchude;
        $orm->tenchude_slug = Str::slug($request->tenchude, '-');
        $orm->save();

        return redirect()->route('admin.chude')->with('status', 'Thêm mới thành công');
    }

    public function getSua($id)
    {
        $chude = ChuDe::find($id);
        return view('admin.chude.sua', compact('chude'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tenchude' => ['required', 'max:255', 'unique:chude,tenchude,'.$id],
        ],
        $messages = [
            'required' => 'Tên chủ đề không được bỏ trống.',
            'unique' => 'Tên chủ đề đã có trong hệ thống.',
        ]);
           
        $orm = ChuDe::find($id);
        $orm->tenchude = $request->tenchude;
        $orm->tenchude_slug = Str::slug($request->tenchude, '-');
        $orm->save();

        return redirect()->route('admin.chude')->with('status', 'Cập nhật thành công');

    }

    public function getXoa($id)
    {
        $orm = ChuDe::find($id);
        $orm->delete();
    
        return redirect()->route('admin.chude')->with('status', 'Xóa thành công');
    }
}
