<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login() {
        if (!empty(Request::post())) {
            $data = Request::only('username', 'password');
            $data['role'] = 2;
            $data['status'] = 1;
            if (Auth::attempt($data)) {
                $count_product_in_cart = Cart::where('user_id', Auth::user()->id)->count();
                $data = [
                    'message' => 'Đăng nhập thành công',
                    'count_product_in_cart' => $count_product_in_cart,
                    'success' => true
                ];
            } else {
                $data = [
                    'message' => 'Tài khoản hoặc mật khẩu chưa đúng',
                    'success' => false
                ];
            }
        } else {
            $data = [
                'message' => 'Dữ liệu chưa đúng',
                'success' => false
            ];
        }
        return response()->json($data, 200);
    }

    public function profile() {
        $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Bạn chưa đăng nhập.'
            ];
            return redirect()->route('web.home')->with('message', $message);
        } else {
            $data['profile'] = Profile::where('user_id', $user->id)->first();
            return view('web.user.profile', $data);
        }
    }
    public function updateProfile() {
         $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Bạn chưa đăng nhập.'
            ];
            return redirect()->route('web.home')->with('message', $message);
        } else {
            $validator = Validator::make(Request::all(), [
                'full_name'    => 'required',
                'phone_number' => 'required',
                'address'      => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            try {
                $post_data = Request::post();
                $profile = Profile::where('user_id', $user->id)->first();
                $profile->full_name = $post_data['full_name'];
                $profile->phone_number = $post_data['phone_number'];
                $profile->address = $post_data['address'];
                $profile->save();
                $message = [
                    'type'    => 'success',
                    'content' => 'Thao tác thành công.'
                ];
                return back()->with('message', $message)->withInput();
            } catch (\Throwable $th) {
                $message = [
                    'type'    => 'error',
                    'content' => 'Thao tác không thành công.'
                ];
                return back()->with('message', $message)->withInput();
            }
        }
    }
    public function changePassword() {
         $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Bạn chưa đăng nhập.'
            ];
            return redirect()->route('web.home')->with('message', $message);
        } else {
            $validator = Validator::make(Request::all(), [
                'password'     => 'required|required_with:re_password|same:re_password',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            try {
                $post_data = Request::post();
                $account = User::findOrFail($user->id);
                $account->password = bcrypt($post_data['password']);
                $account->save();
                $message = [
                    'type'    => 'success',
                    'content' => 'Đổi mật khẩu thành công.'
                ];
                return back()->with('message', $message)->withInput();
            } catch (\Throwable $th) {
                $message = [
                    'type'    => 'error',
                    'content' => 'Đổi mật khẩu không thành công.'
                ];
                return back()->with('message', $message)->withInput();
            }
        }
    }

    public function register() {
        if (!empty(Request::post())) { 
            $validator = Validator::make(Request::all(), [
                'username'     => 'required',
                'password'     => 'required|required_with:re_password|same:re_password',
                'full_name'    => 'required',
                'phone_number' => 'required|unique:profile',
                'address'      => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $post_data = Request::post();

            try {
                DB::BeginTransaction();
                $account = new User();
                $account->username = $post_data['username'];
                $account->password = bcrypt($post_data['password']);
                $account->status = 1;
                $account->role = 2;
                $account->save();
                $profile = new Profile();
                $profile->user_id = $account->id;
                $profile->full_name = $post_data['full_name'];
                $profile->phone_number = $post_data['phone_number'];
                $profile->address = $post_data['address'];
                $profile->save();
                DB::Commit();
                $message = [
                    'type' => 'success',
                    'content' => 'Đăng ký tài khoản thành công'
                ];
                return redirect()->route('web.home')->with('message', $message);
            } catch (\Exception $ex) {
                DB::RollBack();
                $message = [
                    'type' => 'error',
                    'content' => $ex->getMessage()
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        return view('web.user.register');
    }

    public function logout() {
        Auth::logout();
        $message = [
            'type'    => 'success',
            'content' => 'Đăng xuất thành công.'
        ];
        return redirect()->back()->with('message', $message);
    }
}
