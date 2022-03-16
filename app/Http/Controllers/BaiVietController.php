<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\ChuDe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BaiVietController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {        
        if(auth::user()->role == 'staff')
        {
            $baiviet = BaiViet::orderBy('created_at', 'desc')->where('user_id',auth::user()->id)->get();
            return view('admin.baiviet.danhsach',compact('baiviet'));
        }

        $baiviet = BaiViet::orderBy('created_at', 'desc')->get();
        return view('admin.baiviet.danhsach',compact('baiviet'));
    }

    public function getOnOffHienThi($id)
    {
        $orm = BaiViet::find($id);
        $orm->hienthi = 1 - $orm->hienthi; 
        $orm->save();

        return redirect()->route('admin.baiviet');
    }

    public function getOnOffDuyet($id)
    {
        $orm = BaiViet::find($id);
        $orm->kiemduyet = 1 - $orm->kiemduyet; 
        $orm->save();

        return redirect()->route('admin.baiviet');
    }

    public function getOnOffBinhLuan($id)
    {
        $orm = BaiViet::find($id);
        $orm->binhluan = 1 - $orm->binhluan; 
        $orm->save();

        return redirect()->route('admin.baiviet');
    }

    public function getThem()
    {
        $chude = ChuDe::all();
        return view('admin.baiviet.them',compact('chude'));
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'tieude' => ['required','string', 'unique:baiviet'],
            'noidung' => ['required'],
            'chude_id' => ['required'],

        ],
        $messages = [
            'tieude.required' => 'Tiêu đề không được bỏ trống.',
            'noidung.required' => 'Nội dung  không được bỏ trống.',
            'chude_id.required' => 'Chưa chọn chủ đề.',

        ]);
           
        $orm = new BaiViet();
        $orm->user_id = Auth::user()->id;
        $orm->chude_id = $request->chude_id;
        $orm->tieude = $request->tieude;
        $orm->tieude_slug = Str::slug($request->tieude, '-');
        $orm->tomtat = $request->tomtat;
        $orm->noidung = $request->noidung;
        if(Auth::user()->role == 'admin')
        {
            $orm->binhluan = 1;
            $orm->kiemduyet = 1;
            $orm->hienthi = 1;

        }
        $orm->save();

        return redirect()->route('admin.baiviet')->with('status','Thêm mới thành công');
    }

    public function getSua($id)
    {
        $baiviet = BaiViet::find($id);
        $chude = ChuDe::all();
        return view('admin.baiviet.sua', compact('baiviet','chude'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tieude' => ['required', 'string', 'unique:baiviet,tieude,'.$id],
            'noidung' => ['required'],
            'chude_id' => ['required'],

        ],
        $messages = [
            'tieude.required' => 'Tiêu đề không được bỏ trống.',
            'noidung.required' => 'Nội dung  không được bỏ trống.',
            'chude_id.required' => 'Chưa chọn chủ đề.',

        ]);
           
        $orm = BaiViet::find($id);
        $orm->user_id = Auth::user()->id;
        $orm->chude_id = $request->chude_id;
        $orm->tieude = $request->tieude;
        $orm->tieude_slug = Str::slug($request->tieude, '-');
        $orm->tomtat = $request->tomtat;
        $orm->noidung = $request->noidung;
        $orm->luotxem = $orm->luotxem;
        $orm->binhluan = $orm->binhluan;
        $orm->kiemduyet = $orm->kiemduyet;
        $orm->hienthi = $orm->hienthi;
        $orm->save();

        return redirect()->route('admin.baiviet')->with('status','Cập nhật thành công');

    }

    public function getXoa($id)
    {
        $orm = BaiViet::find($id);
        $orm->delete();
    
        return redirect()->route('admin.baiviet')->with('status','Xóa thành công');
    }
    
    public function getSuaBaiVietInfo($id)
    {
        $baiviet = BaiViet::find($id);
        $chude = ChuDe::all();

        return view('admin.baiviet.suainfo', compact('baiviet','chude'));
    }

    public function postSuaBaiVietInfo(Request $request, $id)
    {
        $this->validate($request, [
            'tieude' => ['required', 'string', 'unique:baiviet,tieude,'.$id],
            'noidung' => ['required'],
            'chude_id' => ['required'],

        ],
        $messages = [
            'tieude.required' => 'Tiêu đề không được bỏ trống.',
            'noidung.required' => 'Nội dung  không được bỏ trống.',
            'chude_id.required' => 'Chưa chọn chủ đề.',

        ]);
           
        $orm = BaiViet::find($id);
        $orm->user_id = Auth::user()->id;
        $orm->chude_id = $request->chude_id;
        $orm->tieude = $request->tieude;
        $orm->tieude_slug = Str::slug($request->tieude, '-');
        $orm->tomtat = $request->tomtat;
        $orm->noidung = $request->noidung;
        $orm->luotxem = $orm->luotxem;
        $orm->binhluan = $orm->binhluan;
        $orm->kiemduyet = $orm->kiemduyet;
        $orm->hienthi = $orm->hienthi;
        $orm->save();

        return redirect()->route('admin.nguoidung.info',Auth::user()->name)->with('status','Cập nhật thành công');

    }

    public function getXoaInfo($id)
    {
        $orm = BaiViet::find($id);
        $orm->delete();
    
        return redirect()->route('admin.nguoidung.info',Auth::user()->name)->with('status','Xóa thành công');
    }
    
}
