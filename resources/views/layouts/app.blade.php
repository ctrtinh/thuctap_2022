<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản trị | CameraStore</title>

    <link href="{{ asset('public/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('public/admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="https://fontawesome.com/search?q=bag&s=solid%2Cbrands">
    
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <!-- <i class="fas fa-laugh-wink"></i> -->
                        <img src="{{ asset('public/assets/img/come (1).png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                    </div>
                    <div class="sidebar-brand-text mx-3">CameraStore</div>
                </a>
                <div class=" d-none d-md-inline navbar-nav user-panel pb-1 mb-2 ml-3 d-flex">
                    <div class="info">
                        @if(Auth::user() != null)
                            <h2 class="badge bg-info text-dark" >{{ Auth::user()->name }}</h2> <br>
                            <p class="badge bg-warning text-dark">{{ Auth::user()->role }}</p>
                        @endif
                    </div>
                </div>    
                <hr class="sidebar-divider my-0">
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"> Đăng nhập </i></a>
                </li>
            @endif
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.sanpham') }}">
                    <i class="fas fa-fw fas fa-boxes"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>
            <hr class="sidebar-divider">
     

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý danh mục</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.loai') }}">Loại</a>
                        <a class="collapse-item" href="{{ route('admin.thuonghieu') }}">Thương hiệu</a>
                        <a class="collapse-item" href="{{ route('admin.tinhtrang') }}">Tình trạng</a>
                        <a class="collapse-item" href="{{ route('admin.dungluong') }}">Dung lượng</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-newspaper"></i>    
                    <span>Quản lý bài viết</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.chude') }}">Chủ đề</a>
                        <a class="collapse-item" href="{{ route('admin.baiviet') }}">Bài viết</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
         

            <!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.nguoidung') }}">
                    <i class="fas fa-users"></i>
                    <span>Người dùng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.donhang.doanhthu') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Doanh thu</span></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.donhang') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Đặt hàng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-user"></i>
                    <span>Tài khoản</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.nguoidung.info',['name' => Auth::user()->name ]) }}">Thông tin tài khoản</a>
                        <a class="collapse-item"  href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">	
						    Đăng xuất
						</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                             @csrf
                        </form>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            @endguest   

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                        <div class="col-sm-6 ">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                       </ol>
				        </div>
                    </div>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
              

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Bởi Cao Trung Tình 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    

    <script src="{{ asset('public/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('public/admin/js/sb-admin-2.min.js')}}"></script>
    <script src="{{ asset('public/admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('public/admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('public/admin/js/demo/chart-pie-demo.js')}}"></script>


	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
		
		$(document).ready(function() {
			$("#table_id").DataTable({
				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
				"iDisplayLength": 10,
				"oLanguage": {
					"sLengthMenu": "Hiện _MENU_ dòng",
					"oPaginate": {
						"sFirst": "<i class='fas fa-step-backward'></i>",
						"sLast": "<i class='fas fa-step-forward'></i>",
						"sNext": "<i class='fas fa-chevron-right'></i>",
						"sPrevious": "<i class='fas fa-chevron-left'></i>"
					},
					"sEmptyTable": "Không có dữ liệu",
					"sSearch": "Tìm kiếm:",
					"sZeroRecords": "Không có dữ liệu",
					"sInfo": "Hiện từ _START_ đến _END_ của _TOTAL_ dòng",
					"sInfoEmpty" : "Không tìm thấy",
					"sInfoFiltered": " (tổng số _MAX_ dòng)"
				}
			});
			$("#table_id").wrap('<div class="table-responsive"></div>');
		});
	</script>
</body>

</html>