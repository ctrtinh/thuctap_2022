<?php

namespace App\Http\Controllers;

use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Imports\ThuongHieuImport;
use App\Exports\ThuongHieuExport;
use Excel;

class ThuongHieuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getDanhSach()
    {
        $thuonghieu = ThuongHieu::all();
        return view('admin.thuonghieu.danhsach',compact('thuonghieu'));
    }

   // Nhập từ Excel
   public function postNhap(Request $request)
   {
       Excel::import(new ThuongHieuImport, $request->file('file_excel'));

       return redirect()->route('admin.thuonghieu');
   }

   public function getXuat()
   {
       $response = Excel::download(new ThuongHieuExport, 'danh-sach-thuong-hieu.xlsx');
       ob_end_clean();
       return $response;    
   }

    public function getThem()
    {
        return view('admin.thuonghieu.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'tenthuonghieu' => ['required', 'max:255', 'unique:thuonghieu'],
            'hinhanh' => ['nullable','image','max:1024']
        ],
        $messages = [
            'required' => 'Tên thương hiệu không được bỏ trống.',
            'unique' => 'Tên thương hiệu đã có trong hệ thống.',
            'image' => 'Chỉ cho phép tập tin JPG, PNG, GIF!.',
            'max' => 'Chỉ cho phép tập tin từ 2MB trở xuống!',
        ]);

        if($request->hasFile('hinhanh'))
        {           
            $extension = $request->file('hinhanh')->extension();
            $fileName = Str::slug($request->tenthuonghieu, '-'). '.' . $extension;
            $path = Storage::putFileAs('thuonghieu', $request->file('hinhanh'), $fileName);
        }

        $orm = new ThuongHieu();
        $orm->tenthuonghieu = $request->tenthuonghieu;
        $orm->tenthuonghieu_slug = Str::slug($request->tenthuonghieu, '-');
        if(!empty($path)) $orm->hinhanh = $path;
        $orm->save();

        return redirect()->route('admin.thuonghieu')->with('status', 'Thêm mới thành công');
    }

    public function getSua($id)
    {
        $thuonghieu = ThuongHieu::find($id);
        return view('admin.thuonghieu.sua', compact('thuonghieu'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'tenthuonghieu' => ['required', 'max:255', 'unique:thuonghieu,tenthuonghieu,'.$id],
            'hinhanh' => ['nullable','image','max:1024']
        ],
        $messages = [
            'required' => 'Tên thương hiệu không được bỏ trống.',
            'unique' => 'Tên thương hiệu đã có trong hệ thống.',
            'image' => 'Chỉ cho phép tập tin JPG, PNG, GIF!.',
            'max' => 'Chỉ cho phép tập tin từ 2MB trở xuống!',
        ]);

        if($request->hasFile('hinhanh'))
        {   
            $orm = ThuongHieu::find($id);
            Storage::delete($orm->hinhanh);


            $extension = $request->file('hinhanh')->extension();
            $fileName = Str::slug($request->tenthuonghieu, '-'). '.' . $extension;
            $path = Storage::putFileAs('thuonghieu', $request->file('hinhanh'), $fileName);
        }

        $orm = ThuongHieu::find($id);
        $orm->tenthuonghieu = $request->tenthuonghieu;
        $orm->tenthuonghieu_slug = Str::slug($request->tenthuonghieu, '-');
        if(!empty($path)) $orm->hinhanh = $path;
        $orm->save();

        return redirect()->route('admin.thuonghieu')->with('status', 'Cập nhật thành công');
                      // Kiểm tra
                    //   $this->validate($request, [
                    //     'tenthuonghieu' => ['required', 'string', 'max:191', 'unique:thuonghieu,tenthuonghieu,' . $id],
                    //     'hinhanh' => ['nullable', 'image', 'max:1024']
                    //   ],
                    // $messages = [
                    //     'required' => 'Tên thương hiệu không được bỏ trống.',
                    //     'unique' => 'Tên thương hiệu đã có trong hệ thống.',
                    //     'image' => 'Chỉ cho phép tập tin JPG, PNG, GIF!.',
                    //     'max' => 'Chỉ cho phép tập tin từ 2MB trở xuống!',
                    // ]);
                    
                    // // Upload hình ảnh
                    // $path = '';
                    // if($request->hasFile('hinhanh'))
                    // {
                    //     // Xóa file cũ
                    //     $orm = ThuongHieu::find($id);
                    //     Storage::delete($orm->hinhanh);
                        
                    //     // Upload file mới
                    //     $extension = $request->file('hinhanh')->extension();
                    //     $filename = Str::slug($request->tenthuonghieu, '-') . '.' . $extension;
                    //     $path = Storage::putFileAs('thuong-hieu', $request->file('hinhanh'), $filename);
                    // }
                    
                    // // Sửa
                    // $orm = ThuongHieu::find($id);
                    // $orm->tenthuonghieu = $request->tenthuonghieu;
                    // $orm->tenthuonghieu_slug = Str::slug($request->tenthuonghieu, '-');
                    // if(!empty($path)) $orm->hinhanh = $path;
                    // $orm->save();
                    
                    // Quay về danh sách
                    // return redirect()->route('admin.thuonghieu')->with('status', 'Cập nhật thành công');
        


    }

    public function getXoa($id)
    {
        $orm = ThuongHieu::find($id);
        $orm->delete();

        Storage::delete($orm->hinhanh);
        return redirect()->route('admin.thuonghieu')->with('status', 'Xóa thành công');
    }
}
