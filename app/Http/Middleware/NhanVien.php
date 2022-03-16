<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhanVien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == "admin" || Auth::user()->role == "staff")
		{
			return $next($request);
		}
		return redirect()->route('admin.forbidden')->with('error_message', 'Người dùng không đủ quyền hạn để thao tác chức năng này!');    
    }
}
