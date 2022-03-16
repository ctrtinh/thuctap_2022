<?php

namespace App\Http\Controllers;

use App\Models\HinhAnh;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class HinhAnhController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach($tensanpham_slug)
    {
        $sanpham = SanPham::where('tensanpham_slug',$tensanpham_slug)->first();
        $hinhanh = HinhAnh::where('sanpham_id', $sanpham->id)->get();

        return view('admin.hinhanh.danhsach', compact('hinhanh','sanpham'));
    }
   
    public function getThem($tensanpham_slug)
    {
        $sanpham = SanPham::where('tensanpham_slug',$tensanpham_slug)->first();
        return view('admin.hinhanh.them', compact('sanpham'));
    }

    public function postThem(Request $request, $tensanpham_slug)
    {
        $this->validate($request, [
            'HinhAnh' => ['required'],
            'HinhAnh.*' => ['mimes:jpeg,png,jpg,gif,svg', 'image', 'max:1024'],
        ],
        $messages = [
            'required' => 'Hình ảnh không được bỏ trống.',
            'image' => 'Phải là hình ảnh.',
            'mimes' => 'Hình ảnh chỉ hỗ trợ các định dạng jpeg,png,jpg,gif,svg.',
        ]);

        $sanpham = SanPham::where('tensanpham_slug',$tensanpham_slug)->first();

        if ($request->hasfile('HinhAnh')) {
            $images = $request->file('HinhAnh');
    
            foreach($images as $image) 
            {

                $extension = $image->getClientOriginalName();                
                $fileName = $tensanpham_slug. '-' . $extension;
                $path = Storage::putFileAs('sanpham', $image, $fileName);

                $img = new HinhAnh();
                $img->hinhanh = $path;
                $img->sanpham_id = $sanpham->id;
                $img->save();
                
            }
            
        }

        return redirect()->route('admin.hinhanh',$tensanpham_slug);
    }
    
    public function getSua($id)
    {
        $hinhanh = HinhAnh::find($id);
        return view('admin.hinhanh.sua', compact('hinhanh'));      
    }
    
    public function postSua(Request $request, $id)
    {   
        $this->validate($request, [
            'HinhAnh' => ['required','mimes:jpeg,png,jpg,gif,svg', 'image', 'max:1024'],
        ],
        $messages = [
            'required' => 'Hình ảnh không được bỏ trống.',
            'image' => 'Phải là hình ảnh.',
            'mimes' => 'Hình ảnh chỉ hỗ trợ các định dạng jpeg,png,jpg,gif,svg.',
        ]);

        $hinhanh = HinhAnh::find($id);
        $sanpham = SanPham::Where('id',$hinhanh->sanpham_id)->first();

        $hinhanh->delete();
        Storage::delete($hinhanh->hinhanh);

        $images = $request->file('HinhAnh');        
        $extension = $images->getClientOriginalName();                
        $fileName = $sanpham->tensanpham_slug. '-' . $extension;
        $path = Storage::putFileAs('sanpham', $images, $fileName);

        $img = new HinhAnh();
        $img->hinhanh = $path;
        $img->sanpham_id = $sanpham->id;
        $img->save();

        return redirect()->route('admin.hinhanh',$sanpham->tensanpham_slug);

    }
    
    public function getXoa($id)
    {       
        $orm = HinhAnh::find($id);
        
        $orm->delete();
        Storage::delete($orm->hinhanh);

        if($orm->sanpham_id != null)
        {
            $sanpham = SanPham::where('id',$orm->sanpham_id)->first();
            return redirect()->route('admin.hinhanh',$sanpham->tensanpham_slug);
        }
        else
        {
            return redirect()->route('admin.sanpham');
        }
              
    }
}
