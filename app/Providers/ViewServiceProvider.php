<?php

namespace App\Providers;

use App\Models\ThuongHieu;
use App\Models\Loai;
use Illuminate\Support\Facades\Auth;
use App\Models\SanPhamYeuThich;
use App\Models\DungLuong;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        View::composer('layouts.frontend', function ($view) {
            $type = ThuongHieu::orderBy('tenthuonghieu')->get();
            $view->with('type',$type);
        });

        // if(Auth::check()){
        //     View::composer('layouts.frontend', function ($view) {
        //         $sanphamyeuthich = SanPhamYeuThich::where('user_id', Auth::user()->id)->get();
        //         $view->with('sanphamyeuthich',$sanphamyeuthich);
        //     });
        // }
        
        View::composer('layouts.frontend', function ($view) {
            $loai = Loai::orderBy('tenloai')->get();
            $view->with('loai',$loai);
        });
        View::composer('layouts.frontend', function ($view) {
            $dungluong = DungLuong::orderBy('dungluong')->get();
            $view->with('dungluong',$dungluong);
        });
        View::composer('frontend.thuonghieu', function ($view) {
            $locloai = Loai::orderBy('tenloai')->get();
            $view->with('locloai',$locloai);
        });
        View::composer('frontend.thuonghieu', function ($view) {
            $locth = ThuongHieu::orderBy('tenthuonghieu')->get();
            $view->with('locth',$locth);
        });

        View::composer('frontend.thuonghieu', function ($view) {
            $locdungluong = DungLuong::orderBy('dungluong')->get();
            $view->with('locdungluong',$locdungluong);
        });
       

        View::composer('frontend.sanpham', function ($view) {
            $locloai = Loai::orderBy('tenloai')->get();
            $view->with('locloai',$locloai);
        });
        View::composer('frontend.sanpham', function ($view) {
            $locth = ThuongHieu::orderBy('tenthuonghieu')->get();
            $view->with('locth',$locth);
        });

        View::composer('frontend.sanpham', function ($view) {
            $locdungluong = DungLuong::orderBy('dungluong')->get();
            $view->with('locdungluong',$locdungluong);
        });
       
        
        View::composer('frontend.index', function ($view) {
            $locth = ThuongHieu::orderBy('tenthuonghieu')->get();
            $view->with('locth',$locth);
        });
        View::composer('frontend.index', function ($view) {
            $locloai = Loai::orderBy('tenloai')->get();
            $view->with('locloai',$locloai);
        });

        View::composer('frontend.index', function ($view) {
            $locdungluong = DungLuong::orderBy('dungluong')->get();
            $view->with('locdungluong',$locdungluong);
        });
       
        View::composer('frontend.home', function ($view) {
            $locth = ThuongHieu::orderBy('tenthuonghieu')->get();
            $view->with('locth',$locth);
        });
    }
}