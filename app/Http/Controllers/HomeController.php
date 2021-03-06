<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\HinhAnh;
use App\Models\BaiViet;
use App\Models\Lienhe;
use App\Models\BinhLuan;
use App\Models\ChuDe;
use App\Models\DonHang;
use App\Models\Loai;
use App\Models\ThuongHieu;
use App\Models\DonHang_ChiTiet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Socialite;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\DatHangEmail;
use Illuminate\Support\Facades\Mail;



class HomeController extends Controller
{

    public function getHome()
    {
        
        $loai1 = Loai::where('id', 1)->get();
        $loai2 = Loai::where('id', 2)->get();
        $loai3 = Loai::where('id', 3)->get();
        $loai4 = Loai::where('id', 4)->get();

        $sanpham = SanPham::select( 'sanpham.*',
        DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->where('sanpham.hienthi',1)
        ->where('sanpham.soluong','>',0)    
        ->paginate(9);


        $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        ->select('sanpham.*',
            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        )            
        ->groupBy('sanpham.id')
        ->orderBy('tongsoluongban', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->limit(8)->get();

        $sanphammoi = SanPham::select( 'sanpham.*',DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->orderBy('created_at', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->paginate(8);

        return view('frontend.home', compact('topsanpham', 'sanphammoi', 'sanpham', 'loai1', 'loai2', 'loai3', 'loai4'));

    }

    public function getIndex()
    {
       

        $sanpham = SanPham::select( 'sanpham.*',
        DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->where('sanpham.hienthi',1)
        ->where('sanpham.soluong','>',0)    
        ->paginate(9);

        $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        ->select('sanpham.*',
            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        )            
        ->groupBy('sanpham.id')
        ->orderBy('tongsoluongban', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->limit(8)->get();

        return view('frontend.index', compact('sanpham','topsanpham'));

    }

    public function getDangKy()
    {
        return view('frontend.dangky');
    }
    
    public function getDangNhap()
    {
        return view('frontend.dangnhap');
    }

    public function getLienHe()
    {
    
        return view('frontend.lienhe');
    }
    
    public function postLienHe(Request $request)
    {
        $this->validate($request, [
            'hovaten' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'max:191'],
            'sodienthoai' => ['required', 'string', 'max:12', 'min:10'],
            'noidung' => ['required']
        ]);
        $lienhe = LienHe::all();

        $orm = new LienHe();
        $orm->hovaten = $request->hovaten;
        $orm->email = $request->email;
        $orm->sodienthoai = $request->sodienthoai;
        $orm->noidung = $request->noidung;
        $orm->save();
        session()->flash('success', 'Li??n h??? c???a b???n ???? ???????c ghi nh???n');
       
        return view('frontend.lienhe');
    }

    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function getGoogleCallback()
    {
        try
        {
            $user = Socialite::driver('google')
            ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
            ->stateless()
            ->user();
        }
        catch(Exception $e)
        {
            return redirect()->route('khachhang.dangnhap')->with('warning', 'L???i x??c th???c. Xin vui l??ng th??? l???i!');
        }
            
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser)
        {
            // N???u ng?????i d??ng ???? t???n t???i th?? ????ng nh???p
            Auth::login($existingUser, true);
            return redirect()->route('khachhang');
        }
        else
        {
            // N???u ch??a t???n t???i ng?????i d??ng th?? th??m m???i
            $newUser = User::create([
                'name' => $user->name,
                'username' => Str::before($user->email, '@'),
                'email' => $user->email,
                'password' => Hash::make('camerastore@2022'), // G??n m???t kh???u t??? do
            ]);
            
            // Sau ???? ????ng nh???p
            Auth::login($newUser, true);
            return redirect()->route('khachhang');
    
        }    
    }

    public function getBaiViet_ChiTiet($tieude_slug)
    {
        $baiviet = BaiViet::where('tieude_slug', $tieude_slug)->first();
        $binhluan = BinhLuan::where('baiviet_id', $baiviet->id)->where('hienthi', 1)->get();
        $chude = ChuDe::all();
        
        // C???p nh???t l?????t xem
        $idXem = 'BV' . $baiviet->id;
        if(!session()->has($idXem))
        {
            $orm = BaiViet::find($baiviet->id);
            $orm->LuotXem = $orm->luotxem + 1;
            $orm->save();
            session()->put($idXem, 1);
        }
        return view('frontend.baiviet_chitiet',compact('baiviet','binhluan', 'chude'));
    }

    public  function getBaiViet($chude='')
    {
        if(empty($chude)) // rong
        {
            $baiviet = BaiViet::orderBy('created_at', 'desc')
            ->where([
                        ['hienthi',1],
                        ['kiemduyet', 1],
                    ])
            ->paginate(2);
            $chude = ChuDe::all();
            $session_title = 'Tin t???c';

            return view('frontend.baiviet',compact('baiviet','chude','session_title'));
        }
        else
        {
            $machude = ChuDe::where('tenchude_slug',$chude)->first();
            $baiviet = BaiViet::orderBy('created_at', 'desc')
                    ->where([
                                ['hienthi',1],
                                ['kiemduyet', 1],
                                ['chude_id',$machude->id]
                            ])
                    ->paginate(5);
            $chude = ChuDe::all();
            $session_title = $machude->tenchude;

            return view('frontend.baiviet',compact('baiviet','chude','session_title'));
        }
        
    }
    public function postBinhLuan(Request $request, $tieude_slug)
    {
        $this->validate($request, [
            'noidung' => ['required','string'],
        ],
        $messages = [
            'noidung.required' => 'N???i dung b??nh lu???n kh??ng ???????c b??? tr???ng.',
        ]);
        $chude = ChuDe::all();
        $baiviet = BaiViet::where('tieude_slug', $tieude_slug)->first();
        $binhluan = BinhLuan::where('baiviet_id', $baiviet->id)->where('hienthi', 1)->get();

        $orm = new BinhLuan();
        $orm->user_id = Auth::user()->id;
        $orm->baiviet_id = $baiviet->id;
        $orm->noidung = $request->noidung;
        $orm->save();
        session()->flash('success', 'B??nh lu???n c???a b???n ???? ???????c ghi nh???n');

        return view('frontend.baiviet_chitiet', compact('baiviet','binhluan', 'chude'));
    }

    public function LayHinhDauTien($strNoiDung)
	{
		$first_img = "";
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strNoiDung, $matches);
		if(empty($output))
			return  env('APP_URL')."/storage/app/image/noimage.jpg";
		else
			return $matches[1][0];
	}
    public function getSanPham()
    {
      
        $sanpham = SanPham::select( 'sanpham.*',
        DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->where('sanpham.hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->paginate(9);

        $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        ->select('sanpham.*',
            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        )            
        ->groupBy('sanpham.id')
        ->orderBy('tongsoluongban', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->limit(10)->get();
        
          
        return view('frontend.sanpham', compact('sanpham', 'topsanpham' ));

    }
   
    public function postSanPham(Request $request)
    {
        if($request->select1 == 'BUY')
        {
            $sanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
                        ->select('sanpham.*',
                            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
                        )            
                        ->groupBy('sanpham.id')
                        ->orderBy('tongsoluongban', 'desc')
                        ->where('hienthi',1)
                        ->where('sanpham.soluong','>',0)
                        ->paginate(9);

            session()->put('select1', 'BUY');
        }
        elseif($request->select1 == 'NEW') 
        {
            $sanpham = SanPham::select( 'sanpham.*',DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
                    ->orderBy('created_at', 'desc')
                    ->where('hienthi',1)
                    ->where('sanpham.soluong','>',0)
                    ->paginate(9);

            session()->put('select1', 'NEW');
        }
        elseif($request->select1 == 'ASC') 
        {
            $sanpham = SanPham::select( 'sanpham.*',DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
                        ->orderBy('dongia', 'asc')
                        ->where('hienthi',1)
                        ->where('sanpham.soluong','>',0)
                        ->paginate(9);

            session()->put('select1', 'ASC');
        }  
        elseif($request->select1 == 'DESC') 
        {
            $sanpham = SanPham::select( 'sanpham.*',DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
                ->orderBy('dongia', 'desc')
                ->where('hienthi',1)
                ->where('sanpham.soluong','>',0)
                ->paginate(9);

            session()->put('select1', 'DESC');
        }      
        else 
        {
            $sanpham = SanPham::select( 'sanpham.*',DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->paginate(9);


            session()->put('select1', 'default');
        }

        // $sanpham = SanPham::select( 'sanpham.*',
        // DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        // ->where('sanpham.hienthi',1)
        // ->where('sanpham.soluong','>',0)
        // ->paginate(9);

        $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        ->select('sanpham.*',
            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        )            
        ->groupBy('sanpham.id')
        ->orderBy('tongsoluongban', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->limit(8)->get();


        return view('frontend.sanpham', compact('sanpham', 'topsanpham'));
    }
    public function postTrang(Request $request)
    {
        if($request->select == '12')
        {
            $sanpham = SanPham::select( 'sanpham.*',
             DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
             ->where('sanpham.hienthi',1)
             ->where('sanpham.soluong','>',0)
             ->paginate(12);

            session()->put('select', '12');
        }
        elseif($request->select == '15') 
        {
            $sanpham = SanPham::select( 'sanpham.*',
             DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
             ->where('sanpham.hienthi',1)
             ->where('sanpham.soluong','>',0)
             ->paginate(15);

            session()->put('select', '15');
        }
        elseif($request->select == '18') 
        {
            $sanpham = SanPham::select( 'sanpham.*',
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
            ->where('sanpham.hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->paginate(18);

            session()->put('select', '18');
        }
        elseif($request->select == '21') 
        {
            $sanpham = SanPham::select( 'sanpham.*',
             DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
             ->where('sanpham.hienthi',1)
             ->where('sanpham.soluong','>',0)
             ->paginate(21);   

            session()->put('select', '21');
        }
        else 
        {
            $sanpham = SanPham::select( 'sanpham.*',
             DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
             ->where('sanpham.hienthi',1)
             ->where('sanpham.soluong','>',0)
             ->paginate(9);
             
            session()->put('select', '9');
        }

        $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        ->select('sanpham.*',
            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        )            
        ->groupBy('sanpham.id')
        ->orderBy('tongsoluongban', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->limit(8)->get();
        
        return view('frontend.sanpham', compact('sanpham', 'topsanpham'));
    }
    public function getSanPham_ChiTiet($tensanpham_slug)
    {
        $sanpham = SanPham::where('tensanpham_slug',$tensanpham_slug)->first();
        $hinhanh = HinhAnh::where('sanpham_id', $sanpham->id)->get();     
        
        $sanphammoi = SanPham::select( 'sanpham.*',DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->orderBy('created_at', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->paginate(8);
        
        // $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        // ->select('sanpham.*',
        //     DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
        //     DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        // )            
        // ->groupBy('sanpham.id')
        // ->orderBy('tongsoluongban', 'desc')
        // ->where('hienthi',1)
        // ->where('sanpham.soluong','>',0)
        // ->limit(8)->get();

        return view('frontend.sanpham_chitiet',compact('sanpham','hinhanh', 'sanphammoi'));
    }
    
    public function getGioHang()
    {
        if(Cart::count() <= 0)
            return view('frontend.giohang_rong');
        else
            return view('frontend.giohang');
    }
    
    public function getGioHang_Them($tensanpham_slug)
    {
        //$sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first();

        $sanpham = SanPham::select( 'sanpham.*',
        DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->where('tensanpham_slug', $tensanpham_slug)->first();
        Cart::add([
            'id' => $sanpham->id,
            'name' => $sanpham->tensanpham,
            'price' => $sanpham->dongia,
            'qty' => 1,
            'weight' => 0,
            'options' => [
                'image' => $sanpham->hinhanh
            ]
        ]);

        return redirect()->route('frontend')->with('status', '???? th??m s???n ph???m v??o gi??? h??ng');
    }
    public function getGioHang_ThemChiTiet(Request $request, $tensanpham_slug)
    {
        $sanpham = SanPham::select( 'sanpham.*',
        DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->where('tensanpham_slug', $tensanpham_slug)->first();
        Cart::add([
            'id' => $sanpham->id,
            'name' => $sanpham->tensanpham,
            'price' => $sanpham->dongia,
            'qty' => $request->qty,
            'weight' => 0,
            'options' => [
                'image' => $sanpham->hinhanh
            ]
        ]);

        return redirect()->route('frontend')->with('status', '???? th??m s???n ph???m v??o gi??? h??ng');
    }
    public function getGioHang_Giam($row_id)
    {
        $row = Cart::get($row_id);
        if($row->qty > 1)
        {
            Cart::update($row_id, $row->qty - 1);
        }
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Tang($row_id)
    {
       $row = Cart::get($row_id);
		$sanpham = SanPham::find($row->id);

		if($row->qty < $sanpham->soluong )
		{
			Cart::update($row_id, $row->qty + 1);
			return redirect()->route('frontend.giohang');
		}
		else			
		return redirect()->route('frontend.giohang')->with("status",'S???n ph???m <strong>'.$sanpham->tensanpham. '</strong> ch??? c??n ' .$sanpham->soluong.'');
    }
    public function getGioHang_Xoa($row_id)
    {
        Cart::remove($row_id);
        return redirect()->route('frontend.giohang');
    }
    
    public function getGioHang_XoaTatCa()
    {
        Cart::destroy();
        return redirect()->route('frontend.giohang');
    }
    public function getDatHang()
    {
        if(!Auth::check())
			return redirect()->route('khachhang.dangnhap');
		else
            return view('frontend.dathang');
    }

    public function postDatHang(Request $request)
    {
        $this->validate($request, [
            'diachigiaohang' => ['required', 'max:255'],
            'dienthoaigiaohang' => ['required','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/','min:10','numeric'],
            'email' => ['required', 'string', 'email', 'max:255'],

        ],
        $messages = [
            'diachigiaohang.required' => '?????a ch??? giao h??ng kh??ng ???????c b??? tr???ng.',
            'dienthoaigiaohang.required' => '??i???n tho???i giao h??ng kh??ng ???????c b??? tr???ng.',
            'email.required' => '?????a ch??? email kh??ng ???????c b??? tr???ng.',
            'email.email' => '?????a ch??? email kh??ng kh??ng ????ng.',
            'dienthoaigiaohang.regex' => 'S??? ??i???n tho???i kh??ng ????ng.',
            'dienthoaigiaohang.min' => 'S??? ??i???n tho???i ph???i ????? 10 s???.',
            'dienthoaigiaohang.numeric' => 'S??? ??i???n tho???i ph???i l?? s???.',

        ]);
        
        // L??u v??o ????n h??ng
        $dh = new DonHang();    
        $dh -> user_id = Auth::user()->id;
        $dh -> tinhtrang_id = 1;
        $dh -> diachigiaohang = $request->diachigiaohang;
        $dh -> dienthoaigiaohang = $request->dienthoaigiaohang;
        $dh -> chitietgiaohang = $request->chitietgiaohang;
        $dh ->save();
    
        // L??u v??o ????n h??ng chi ti???t
        foreach(Cart::content() as $value)
        {
            $ct = new DonHang_ChiTiet();
            $ct->donhang_id = $dh->id;
            $ct->sanpham_id = $value->id;
            $ct->soluongban = $value->qty;
            $ct->dongiaban = $value->price;
            $ct->save();

            $sp = SanPham::find($value->id);
            $sp->soluong = $sp->soluong - $value->qty;
            $sp->save();
        }
        Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));
        return redirect()->route('frontend.dathangthanhcong');

    }
    
    public function getDatHangThanhCong()
    {
        $cart = Cart::content();
        $cartsub = Cart::subtotal();
        $cartcount = Cart::count() ;
        // X??a gi??? h??ng khi ho??n t???t ?????t h??ng?
        Cart::destroy();
        
        return view('frontend.dathangthanhcong',compact('cart','cartsub','cartcount'));
    }
    public function getSearch(Request $request)
    {
          
        $sanpham = SanPham::select( 'sanpham.*',
        DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
        ->where('sanpham.hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->where('sanpham.tensanpham','like', '%' . $request->key . '%')
        ->paginate(9);
        $session_title = $request->key;

        $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
        ->select('sanpham.*',
            DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
        )            
        ->groupBy('sanpham.id')
        ->orderBy('tongsoluongban', 'desc')
        ->where('hienthi',1)
        ->where('sanpham.soluong','>',0)
        ->limit(10)->get();

        return view('frontend.thuonghieu', compact('sanpham','session_title', 'topsanpham'));

    }
    public function getThuongHieu($all = '')
    {
		if($all == 'all')
        {
            $sanpham = SanPham::select( 'sanpham.*',
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
            ->where('sanpham.hienthi',1)
            ->paginate(9);
            $session_title = "Th????ng hi???u";

            $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
            )            
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->limit(8)->get();

            return view('frontend.thuonghieu',compact('sanpham','session_title', 'topsanpham'));

        }
        else
        {
            $thuonghieu = ThuongHieu::where('tenthuonghieu_slug',$all)->first();
            $sanpham = SanPham::select( 'sanpham.*',
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
                ->where('sanpham.hienthi',1)->where('thuonghieu_id',$thuonghieu->id)
                ->paginate(9);
            $session_title = $thuonghieu->tenthuonghieu;

            $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
            )            
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->limit(8)->get();

            

            return view('frontend.thuonghieu',compact('sanpham','session_title', 'topsanpham'));

        }
        
 
    }
    public function getLoai($all = '')
    {
		if($all == 'all')
        {
            $sanpham = SanPham::select( 'sanpham.*',
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
            ->where('sanpham.hienthi',1)
            ->paginate(9);
            $session_title = "Lo???i";

            $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
            )            
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->limit(10)->get();

            return view('frontend.thuonghieu',compact('sanpham','session_title', 'topsanpham'));

        }
        else
        {
            $loai = Loai::where('tenloai_slug',$all)->first();
            $sanpham = SanPham::select( 'sanpham.*',
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
                ->where('sanpham.hienthi',1)->where('loai_id',$loai->id)
                ->paginate(9);
            $session_title = $loai->tenloai;


            $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
            )            
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->limit(10)->get();

            return view('frontend.thuonghieu',compact('sanpham','session_title', 'topsanpham'));

        }
 
    }

    public function getDungLuong($all = '')
    {
		if($all == 'all')
        {
            $sanpham = SanPham::select( 'sanpham.*',
            DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
            ->where('sanpham.hienthi',1)
            ->paginate(9);
            $session_title = $all;

            $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
            )            
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->limit(10)->get();

            return view('frontend.thuonghieu',compact('sanpham','session_title', 'topsanpham'));

        }
        else
        {
            // $dungluong = DungLuong::where('dungluong_slug',$all)->first();
            $sanpham = SanPham::select( 'sanpham.*',
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh'))
                ->where('sanpham.hienthi',1)->where('tendungluong', $all)
                ->paginate(9);
            $session_title = $all;


            $topsanpham = SanPham::leftJoin('donhang_chitiet', 'sanpham.id', '=', 'donhang_chitiet.sanpham_id')
            ->select('sanpham.*',
                DB::raw('sum(donhang_chitiet.soluongban) AS tongsoluongban'),
                DB::raw('(select hinhanh from hinhanh where sanpham_id = sanpham.id  limit 1) as hinhanh')
            )            
            ->groupBy('sanpham.id')
            ->orderBy('tongsoluongban', 'desc')
            ->where('hienthi',1)
            ->where('sanpham.soluong','>',0)
            ->limit(10)->get();

            return view('frontend.thuonghieu',compact('sanpham','topsanpham','session_title'));

        }
 
    }


}
