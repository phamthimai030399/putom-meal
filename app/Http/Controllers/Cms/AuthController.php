<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login() {
        $uri = Session::has('uri.intended') ? Session::get('uri.intended') : route('dashboard');
        if(Auth::check() && Auth::user()->role != 2) return redirect($uri);
        if (!empty(Request::post())) {
            $data = Request::only('username', 'password');
            $data['status'] = 1;
            if (Auth::attempt($data) && Auth::user()->role != 2) {
                return redirect($uri);
            } else {
                Session::flash('message', 'Đăng nhập không thành công.');
                return back()->withInput();
            }
        }
        return view('cms.layout.login');
    }

    public function changePassword() {
        $data['user'] = Auth::user();
        return view('cms.user.change_password');
    }

    public function logout() {
        Auth::logout();
        $message = [
            'type'    => 'success',
            'content' => 'Đăng xuất thành công.'
        ];
        return redirect()->route('cms.auth.login');
    }
}
