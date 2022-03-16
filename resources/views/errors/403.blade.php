@extends('layouts.app')
@section('title', 'Cấp truy cập')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Không thể truy cập.</h3>

          <p>
			      Người dùng không đủ quyền hạn để truy cập.
            Trong khi đó, bạn có thể <a href="{{route('admin.home')}}">quay về trang chủ quản trị.</a> 
          </p>
        
        </div>
      </div>
    </section>
@endsection