@extends('layouts.frontend')
@section('content')
<section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Tin Tức</h2>
                            <p>Trang Chủ <span>-</span> Tin Tức</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Blog Area =================-->
    <section class="blog_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($baiviet as $value)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                    @php
								    	$img = App\Http\Controllers\HomeController::LayHinhDauTien($value->noidung); 
									@endphp
                                <img class="card-img rounded-0" src="{{$img}}" alt="">
                                <a href="#" class="blog_item_date">
                                <h3>{{$value->created_at->format('d')}}</h3>
                                    <p>{{$value->created_at->format('m')}}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{route('frontend.baiviet_chitiet',['tieude_slug' =>  $value->tieude_slug])}}">
                                    <h2>{{$value->tieude}}</h2>
                                </a>
                                <p>{{$value->tomtat}}</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="far fa-user"></i> {{$value->User->name}}</a></li>
                                    <li><a href="#"><i class="far fa-comments"></i> {{$value->BinhLuan->count()}} Bình luận</a></li>
                                </ul>
                            </div>
                        </article>
                    @endforeach
                     

                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <!-- <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li> -->                          
                                <li class="page-item">
                                {{ $baiviet->links() }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1"
                                    type="submit">Tìm kiếm</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Chủ đề</h4>
                            <ul class="list cat-list">
                                @foreach($chude as $value)
                                    <li>
                                        <a href="{{route('frontend.baiviet_chude',['chude' => $value->tenchude_slug])}}" class="d-flex">
                                            <p>{{$value->tenchude}}</p>
                                        
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">
                                Bản tin</h4>

                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email'" placeholder='Địa chỉ email' required>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1"
                                    type="submit">Chia sẻ</button>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
  @endsection