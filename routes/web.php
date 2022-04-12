<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\HinhAnhController;
use App\Http\Controllers\ChuDeController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\DonHangChiTietController;
use App\Http\Controllers\KhachHangController;


Auth::routes();
Auth::routes(['verify' => true]);
// Trang chủ
Route::get('/', [HomeController::class, 'getHome'])->name('frontend');
Route::get('/index', [HomeController::class, 'getIndex'])->name('frontend.index');

// Trang sản phẩm
Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('frontend.sanpham');
Route::get('/san-pham', [HomeController::class, 'postSanPham'])->name('frontend.sanpham');
Route::post('/san-pham', [HomeController::class, 'postTrang'])->name('frontend.trang');
Route::get('/san-pham/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('frontend.sanpham.chitiet');



//Thương hiệu
Route::get('/thuong-hieu/{all}', [HomeController::class, 'getThuongHieu'])->name('frontend.thuonghieu');
Route::get('/loai/{all}', [HomeController::class, 'getLoai'])->name('frontend.loai');
Route::get('/dung-luong/{all}', [HomeController::class, 'getDungLuong'])->name('frontend.dungluong');
// Route::get('/gia', [HomeController::class, 'getGia'])->name('frontend.gia');




//Tin tức
Route::get('/tin-tuc', [HomeController::class, 'getBaiViet'])->name('frontend.baiviet');
Route::get('/tin-tuc/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('frontend.baiviet_chitiet');
Route::get('/tin-tuc/chu-de/{chude}', [HomeController::class, 'getBaiViet'])->name('frontend.baiviet_chude');

//Bình luận
Route::post('/binh-luan/{tieude_slug}', [HomeController::class, 'postBinhLuan'])->name('frontend.binhluan');

// Liên hệ
Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('frontend.lienhe');
Route::post('/lien-he', [HomeController::class, 'postLienHe'])->name('frontend.lienhe');


// Trang giỏ hàng
Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('frontend.giohang');
Route::get('/gio-hang/them/{tensanpham_slug}', [HomeController::class, 'getGioHang_Them'])->name('frontend.giohang.them');
Route::get('/gio-hang/them/chitiet/{tensanpham_slug}', [HomeController::class, 'getGioHang_ThemChiTiet'])->name('frontend.giohang.them.chitiet');
Route::get('/gio-hang/xoa', [HomeController::class, 'getGioHang_XoaTatCa'])->name('frontend.giohang.xoatatca');
Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('frontend.giohang.xoa');
Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('frontend.giohang.giam');
Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('frontend.giohang.tang');


// Trang đặt hàng
Route::get('/dat-hang', [HomeController::class, 'getDatHang'])->name('frontend.dathang');
Route::post('/dat-hang', [HomeController::class, 'postDatHang'])->name('frontend.dathang');
Route::get('/dat-hang-thanh-cong', [HomeController::class, 'getDatHangThanhCong'])->name('frontend.dathangthanhcong');

// Tìm kiếm
Route::get('/search', [HomeController::class, 'getSearch'])->name('frontend.search');


// Google OAuth
Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');

// Trang khách hàng
Route::get('/khach-hang/dang-ky', [HomeController::class, 'getDangKy'])->name('khachhang.dangky');
Route::get('/khach-hang/dang-nhap', [HomeController::class, 'getDangNhap'])->name('khachhang.dangnhap');

// Trang tài khoản khách hàng
Route::prefix('khach-hang')->group(function() {
    // Trang chủ tài khoản khách hàng
    Route::get('/', [KhachHangController::class, 'getHome'])->name('khachhang');

    // Sản phẩm yêu thích
    Route::get('/danh-sach-san-pham-yeu-thich', [KhachHangController::class, 'getSanPhamYeuThich'])->name('khachhang.danhsachsanpham');
    Route::get('/them-san-pham-yeu-thich/{tensanpham_slug}', [KhachHangController::class, 'getThemSanPhamYeuThich'])->name('khachhang.sanphamthem');
    Route::get('/xoa-san-pham-yeu-thich/{id}', [KhachHangController::class, 'getXoaSanPhamYeuThich'])->name('khachhang.sanpham');
    
    // Xem và cập nhật trạng thái đơn hàng
    Route::get('/donhang', [KhachHangController::class, 'getDonHang'])->name('khachhang.donhang');
    Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang_ChiTiet'])->name('khachhang.donhang.chitiet');
    Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang_ChiTiet'])->name('khachhang.donhang.chitiet');
    Route::get('/donhang-huy/{id}', [KhachHangController::class, 'getDonHangHuy'])->name('khachhang.donhang.huy');

    // Xem và cập nhật mật khẩu
	Route::get('/matkhau', [KhachHangController::class, 'getMatKhau'])->name('khachhang.matkhau');
	Route::post('/matkhau', [KhachHangController::class, 'postMatKhau'])->name('khachhang.matkhau');

    // Cập nhật thông tin tài khoản
	Route::get('/hoso', [KhachHangController::class, 'getHoSo'])->name('khachhang.hoso');
	Route::post('/hoso', [KhachHangController::class, 'postHoSo'])->name('khachhang.hoso');	
});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
// Trang chủ tài khoản quản lý
 Route::get('/home', [AdminController::class, 'getHome'])->name('home');
 Route::get('/403', [AdminController::class, 'getForbidden'])->name('forbidden');

// Quản lý Loại sản phẩm
Route::get('/loai', [LoaiController::class, 'getDanhSach'])->name('loai')->middleware('nhanvien');
Route::get('/loai/them', [LoaiController::class, 'getThem'])->name('loai.them')->middleware('nhanvien');
Route::post('/loai/them', [LoaiController::class, 'postThem'])->name('loai.them')->middleware('nhanvien');
Route::get('/loai/sua/{id}', [LoaiController::class, 'getSua'])->name('loai.sua')->middleware('nhanvien');
Route::post('/loai/sua/{id}', [LoaiController::class, 'postSua'])->name('loai.sua')->middleware('nhanvien');
Route::get('/loai/xoa/{id}', [LoaiController::class, 'getXoa'])->name('loai.xoa')->middleware('nhanvien');

// Quản lý liên hệ
Route::get('/lienhe', [LienHeController::class, 'getDanhSach'])->name('lienhe')->middleware('nhanvien');
Route::get('/lienhe/xoa/{id}', [LienHeController::class, 'getXoa'])->name('lienhe.xoa')->middleware('nhanvien');
Route::get('/lienhe/phanhoi/{id}', [LienHeController::class, 'getPhanHoi'])->name('lienhe.phanhoi')->middleware('nhanvien');
Route::post('/lienhe/phanhoi/{id}', [LienHeController::class, 'postPhanHoi'])->name('lienhe.phanhoi')->middleware('nhanvien');

 // Quản lý Thương Hiệu
 Route::get('/thuonghieu', [ThuongHieuController::class, 'getDanhSach'])->name('thuonghieu')->middleware('nhanvien');
 Route::get('/thuonghieu/them', [ThuongHieuController::class, 'getThem'])->name('thuonghieu.them')->middleware('nhanvien');
 Route::post('/thuonghieu/them', [ThuongHieuController::class, 'postThem'])->name('thuonghieu.them')->middleware('nhanvien');
 Route::get('/thuonghieu/sua/{id}', [ThuongHieuController::class, 'getSua'])->name('thuonghieu.sua')->middleware('nhanvien');
 Route::post('/thuonghieu/sua/{id}', [ThuongHieuController::class, 'postSua'])->name('thuonghieu.sua')->middleware('nhanvien');
 Route::get('/thuonghieu/xoa/{id}', [ThuongHieuController::class, 'getXoa'])->name('thuonghieu.xoa')->middleware('nhanvien');
 Route::post('/thuonghieu/nhap', [ThuongHieuController::class, 'postNhap'])->name('thuonghieu.nhap')->middleware('nhanvien');
 Route::get('/thuonghieu/xuat', [ThuongHieuController::class, 'getXuat'])->name('thuonghieu.xuat')->middleware('nhanvien');


// Quản lý Tình trạng đơn hàng
Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('tinhtrang')->middleware('nhanvien');
Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('tinhtrang.them')->middleware('nhanvien');
Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('tinhtrang.them')->middleware('nhanvien');
Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('tinhtrang.sua')->middleware('nhanvien');
Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('tinhtrang.sua')->middleware('nhanvien');
Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('tinhtrang.xoa')->middleware('nhanvien');


// Quản lý Tài khoản người dùng
Route::get('/nguoidung', [NguoiDungController::class, 'getDanhSach'])->name('nguoidung')->middleware('admin');
Route::get('/nguoidung/them', [NguoiDungController::class, 'getThem'])->name('nguoidung.them')->middleware('admin');
Route::post('/nguoidung/them', [NguoiDungController::class, 'postThem'])->name('nguoidung.them')->middleware('admin');
Route::get('/nguoidung/sua/{id}', [NguoiDungController::class, 'getSua'])->name('nguoidung.sua')->middleware('admin');
Route::post('/nguoidung/sua/{id}', [NguoiDungController::class, 'postSua'])->name('nguoidung.sua')->middleware('admin');
Route::get('/nguoidung/xoa/{id}', [NguoiDungController::class, 'getXoa'])->name('nguoidung.xoa')->middleware('admin');
Route::get('/nguoidung/kichhoat/{id}', [NguoiDungController::class, 'getKichHoat'])->name('nguoidung.kichhoat')->middleware('admin');
// Route::post('/nguoidung/nhap', [NguoiDungController::class, 'postNhap'])->name('nguoidung.nhap')->middleware('admin');
Route::post('/nguoidung/xuat', [NguoiDungController::class, 'postXuat'])->name('nguoidung.xuat')->middleware('admin');
Route::get('/nguoidung/info/{name}', [NguoiDungController::class, 'getInfo'])->name('nguoidung.info')->middleware('nhanvien');
Route::post('/nguoidung/sua/info/{id}', [NguoiDungController::class, 'postSuaInfo'])->name('nguoidung.sua.info')->middleware('nhanvien');


// Quản lý Sản phẩm
Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('sanpham')->middleware('nhanvien');
Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('sanpham.them')->middleware('nhanvien');
Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('sanpham.them')->middleware('nhanvien');
Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('sanpham.sua')->middleware('nhanvien');
Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('sanpham.sua')->middleware('nhanvien');
Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('sanpham.xoa')->middleware('nhanvien');
Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('sanpham.nhap')->middleware('nhanvien');
Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('sanpham.xuat')->middleware('nhanvien');
Route::get('/sanpham/OnOffHienThi/{id}', [SanPhamController::class, 'getOnOffHienThi'])->name('sanpham.OnOffHienThi')->middleware('nhanvien');
Route::get('/sanphamghet/xuat', [SanPhamController::class, 'getXuatSanPhamHet'])->name('sanpham.het.xuat')->middleware('admin');

// Quản lý hình ảnh
Route::get('/hinhanh/{tensanpham_slug}', [HinhAnhController::class, 'getDanhSach'])->name('hinhanh')->middleware('nhanvien');
Route::get('/hinhanh/them/{tensanpham_slug}', [HinhAnhController::class, 'getThem'])->name('hinhanh.them')->middleware('nhanvien');
Route::post('/hinhanh/them/{tensanpham_slug}', [HinhAnhController::class, 'postThem'])->name('hinhanh.them')->middleware('nhanvien');
Route::get('/hinhanh/sua/{id}', [HinhAnhController::class, 'getSua'])->name('hinhanh.sua')->middleware('nhanvien');
Route::post('/hinhanh/sua/{id}', [HinhAnhController::class, 'postSua'])->name('hinhanh.sua')->middleware('nhanvien');
Route::get('/hinhanh/xoa/{id}', [HinhAnhController::class, 'getXoa'])->name('hinhanh.xoa')->middleware('nhanvien');

 // Quản lý chủ đề
 Route::get('/chude', [ChuDeController::class, 'getDanhSach'])->name('chude')->middleware('nhanvien');
 Route::get('/chude/them', [ChuDeController::class, 'getThem'])->name('chude.them')->middleware('nhanvien');
 Route::post('/chude/them', [ChuDeController::class, 'postThem'])->name('chude.them')->middleware('nhanvien');
 Route::get('/chude/sua/{id}', [ChuDeController::class, 'getSua'])->name('chude.sua')->middleware('nhanvien');
 Route::post('/chude/sua/{id}', [ChuDeController::class, 'postSua'])->name('chude.sua')->middleware('nhanvien');
 Route::get('/chude/xoa/{id}', [ChuDeController::class, 'getXoa'])->name('chude.xoa')->middleware('nhanvien');

   // Quản lý bài viết
   Route::get('/baiviet', [BaiVietController::class, 'getDanhSach'])->name('baiviet')->middleware('nhanvien');
   Route::get('/baiviet/them', [BaiVietController::class, 'getThem'])->name('baiviet.them')->middleware('nhanvien');
   Route::post('/baiviet/them', [BaiVietController::class, 'postThem'])->name('baiviet.them')->middleware('nhanvien');
   Route::get('/baiviet/sua/{id}', [BaiVietController::class, 'getSua'])->name('baiviet.sua')->middleware('nhanvien');
   Route::post('/baiviet/sua/{id}', [BaiVietController::class, 'postSua'])->name('baiviet.sua')->middleware('nhanvien');
   Route::get('/baiviet/xoa/{id}', [BaiVietController::class, 'getXoa'])->name('baiviet.xoa')->middleware('nhanvien');
   Route::get('/baiviet/OnOffDuyet/{id}', [BaiVietController::class, 'getOnOffDuyet'])->name('baiviet.OnOffDuyet')->middleware('admin');
   Route::get('/baiviet/OnOffHienThi/{id}', [BaiVietController::class, 'getOnOffHienThi'])->name('baiviet.OnOffHienThi')->middleware('admin');
   Route::get('/baiviet/OnOffBinhLuan/{id}', [BaiVietController::class, 'getOnOffBinhLuan'])->name('baiviet.OnOffBinhLuan')->middleware('admin');
   Route::get('/baiviet/sua/info/{id}', [BaiVietController::class, 'getSuaBaiVietInfo'])->name('baiviet.sua.info')->middleware('nhanvien');
   Route::post('/baiviet/sua/info/{id}', [BaiVietController::class, 'postSuaBaiVietInfo'])->name('baiviet.sua.info')->middleware('nhanvien');
   Route::get('/baiviet/xoa/info/{id}', [BaiVietController::class, 'getXoaInfo'])->name('baiviet.xoa.info')->middleware('nhanvien');

// Quản lý bình luận
Route::get('/binhluan', [BinhLuanController::class, 'getDanhSach'])->name('binhluan.danhsach')->middleware('nhanvien');
Route::get('/binhluan/{tieude_slug}', [BinhLuanController::class, 'getDanhSach'])->name('binhluan')->middleware('nhanvien');
Route::get('/binhluan/them', [BinhLuanController::class, 'getThem'])->name('binhluan.them')->middleware('nhanvien');
Route::post('/binhluan/them', [BinhLuanController::class, 'postThem'])->name('binhluan.them')->middleware('nhanvien');
Route::get('/binhluan/sua/{id}', [BinhLuanController::class, 'getSua'])->name('binhluan.sua')->middleware('nhanvien');
Route::post('/binhluan/sua/{id}', [BinhLuanController::class, 'postSua'])->name('binhluan.sua')->middleware('nhanvien');
Route::get('/binhluan/xoa/{id}', [BinhLuanController::class, 'getXoa'])->name('binhluan.xoa')->middleware('nhanvien');
Route::get('/binhluan/OnOffDuyet/{id}', [BinhLuanController::class, 'getOnOffDuyet'])->name('binhluan.OnOffDuyet')->middleware('nhanvien');

// Quản lý Đơn hàng
Route::get('/donhang', [DonHangController::class, 'getDanhSach'])->name('donhang')->middleware('nhanvien');
Route::get('/donhang/them', [DonHangController::class, 'getThem'])->name('donhang.them')->middleware('admin');
Route::post('/donhang/them', [DonHangController::class, 'postThem'])->name('donhang.them')->middleware('admin');
Route::get('/donhang/sua/{id}', [DonHangController::class, 'getSua'])->name('donhang.sua')->middleware('admin');
Route::post('/donhang/sua/{id}', [DonHangController::class, 'postSua'])->name('donhang.sua')->middleware('admin');
Route::get('/donhang/xoa/{id}', [DonHangController::class, 'getXoa'])->name('donhang.xoa')->middleware('admin');
Route::get('/donhang/moi', [DonHangController::class, 'getDanhSachDonHangMoi'])->name('donhang.moi')->middleware('nhanvien');
Route::post('/donhang/trangthai/{id}', [DonHangController::class, 'postTrangThai'])->name('donhang.trangthai')->middleware('nhanvien');
Route::get('/donhang/doanhthu', [DonHangController::class, 'getDoanhThu'])->name('donhang.doanhthu')->middleware('admin');
Route::get('/donhang/thongdoanhthu', [DonHangController::class, 'getDoanhThu'])->name('donhang.thongkedoanhthu')->middleware('admin');
Route::get('/donhang/ngay', [DonHangController::class, 'getDanhSachNgay'])->name('donhang.ngay')->middleware('admin');

// Quản lý Đơn hàng chi tiết
Route::get('/donhang/chitiet/{id}', [DonHangChiTietController::class, 'getDanhSach'])->name('donhang.chitiet')->middleware('admin');
Route::get('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'getSua'])->name('donhang.chitiet.sua')->middleware('admin');
Route::post('/donhang/chitiet/sua/{id}', [DonHangChiTietController::class, 'postSua'])->name('donhang.chitiet.sua')->middleware('admin');
Route::get('/donhang/chitiet/xoa/{id}', [DonHangChiTietController::class, 'getXoa'])->name('donhang.chitiet.xoa')->middleware('admin');
});

