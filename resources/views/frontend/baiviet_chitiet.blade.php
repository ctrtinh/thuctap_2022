
@extends('layouts.frontend')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg" >
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-lg-8">
               <div class="breadcrumb_iner">
                  <div class="breadcrumb_iner_item">
                     <h2>Chi Tiết Tin Tức</h2>
                     <p>Trang Chủ <span>-</span> Tin Tức</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- breadcrumb start-->
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area padding_top">
      <div class="container">
	  @if(session()->has('success'))
			<div class="alert alert-success thongbao">
				{{ session()->get('success') }}
			</div>
		@endif
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="img/blog/single_blog_1.png" alt="">
                  </div>
                  <div class="blog_details">
                     <h2>	{{$baiviet->tieude}}
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="far fa-user"></i> {{$baiviet->User->name}}</a></li>
                        <li><a href="#"><i class="far fa-comments"></i>{{ $binhluan->count()}} Bình luận</a></li>
                     </ul>
                     <p class="excert">
					 {!!html_entity_decode($baiviet->noidung)!!}
                     </p>
                   
                  </div>
               </div>
              
               <div class="comments-area">
                  <h4>{{ $binhluan->count()}} Bình luận</h4>
				  @foreach($binhluan as $value)
					<div class="comment-list">
						<div class="single-comment justify-content-between d-flex">
							<div class="user justify-content-between d-flex">
							<div class="thumb">
									{{$value->User->name}}
							</div>
							<div class="desc">
								<p class="comment">
									{{$value->noidung}}
								</p>
								<div class="d-flex justify-content-between">
									<div class="d-flex align-items-center">
										<h5>
										<a href="#">{{$value->created}}</a>
										</h5>
										<p class="date">{{$value->created_at->format('d/m/Y H:i:s')}} </p>
									</div>
									
								</div>
							</div>
							</div>
						</div>
					</div>
					@endforeach
               </div>
			@if($baiviet->binhluan == 1)
               <div class="comment-form">
                  <h4>Để lại bình luận</h4>
                  <form class="form-contact comment_form" action="{{route('frontend.binhluan',['tieude_slug' => $baiviet->tieude_slug])}}" method="post"id="commentForm">
				  @csrf
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
						   <textarea  class="form-control w-100 @error('noidung') is-invalid @enderror" name="noidung" id="noidung" cols="30" rows="9"
                                    placeholder="Nội dung "></textarea>
								@error('noidung')
									<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                           </div>
                        </div>
                     </div>
					 @if(Auth::user() == null)
						<div class="form-group mt-3">
							<a href="{{route('khachhang.dangnhap')}}" class="btn_3 button-contactForm">đăng nhập để bình luận </a>
						</div>
					@else
						<div class="form-group mt-3">
							<button type="submit" class="btn_3 button-contactForm">Bình luận</button>
						</div>
					@endif
                  </form>
               </div>
			   @endif
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget search_widget">
                     <form action="#">
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder='Tìm kiếm'
                                 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                              <div class="input-group-append">
                                 <button class="btn" type="button"><i class="ti-search"></i></button>
                              </div>
                           </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">Tiềm kiếm</button>
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
	
                  <aside class="single_sidebar_widget instagram_feeds">
                     <h4 class="widget_title">Instagram </h4>
                     <ul class="instagram_row flex-wrap">
                        <li>
                           <a href="#">
                              <img class="img-fluid" src="{{asset('public/frontend/img/post/post_5.png')}}" alt="">
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <img class="img-fluid" src="{{asset('public/frontend/img/post/post_6.png')}}" alt="">
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <img class="img-fluid" src="{{asset('public/frontend/img/post/post_7.png')}}" alt="">
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <img class="img-fluid" src="{{asset('public/frontend/img/post/post_8.png')}}" alt="">
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <img class="img-fluid" src="{{asset('public/frontend/img/post/post_9.png')}}" alt="">
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <img class="img-fluid" src="{{asset('public/frontend/img/post/post_10.png')}}" alt="">
                           </a>
                        </li>
                     </ul>
                  </aside>
                  <aside class="single_sidebar_widget newsletter_widget">
                     <h4 class="widget_title">  Góp ý</h4>
                     <form action="#">
                        <div class="form-group">
                           <input type="email" class="form-control" onfocus="this.placeholder = ''"
                              onblur="this.placeholder = 'Enter email'" placeholder='Nhập email' required>
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
   <!--================Blog Area end =================-->
  @endsection