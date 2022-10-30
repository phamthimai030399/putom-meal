<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckPermission;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $data['users'] = User::paginate(10);
        $data['permission'] = CheckPermission::getPermission();
        return view('cms.user.index', $data);
    }

    public function add() {
        $data['permission'] = CheckPermission::getPermission();
        if (!empty(Request::post())) {
            $post_data = Request::post();
            $validator = Validator::make(Request::all(), [
                'username'  => 'required|unique:user',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if ($post_data['password'] != $post_data['re_password']) {
                $message = [
                    'type' => 'error',
                    'content' => 'Nhắc lại mật khẩu không khớp'
                ];
                return back()->with('message', $message)->withInput();
            } else {
                $post_data['password'] = bcrypt($post_data['password']);
            }
            try {
                User::create($post_data);
                $message = [
                    'type' => 'success',
                    'content' => 'Thêm user thành công'
                ];
                return redirect()->route('cms.user.list')->with('message', $message);
            } catch (\Throwable $th) {
                $message = [
                    'type' => 'error',
                    'content' => $th->getMessage()
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        return view('cms.user.add', $data);
    }

    public function update($id) {
        $data['oneItem'] = $oneItem = User::findOrFail($id);
        $data['permission'] = CheckPermission::getPermission();
        if (!empty(Request::post())) {
            try {
                $post_data = Request::post();
                if (empty($post_data['password'])) {
                    unset($post_data['password']);
                } else {
                    if ($post_data['password'] != $post_data['re_password']) {
                        $message = [
                            'type' => 'error',
                            'content' => 'Nhắc lại mật khẩu không khớp'
                        ];
                        return back()->with('message', $message)->withInput();
                    } else {
                        $post_data['password'] = bcrypt($post_data['password']);
                    }
                }
                User::updateOrInsert(['id' => $id], $post_data);
                $message = [
                    'type' => 'success',
                    'content' => 'Cập nhật thành công'
                ];
                return redirect()->route('cms.user.list');
            } catch (\Throwable $th) {
                $message = [
                    'type' => 'error',
                    'content' => $th->getMessage()
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        return view('cms.user.update', $data);
    }

    public function delete($id) {
        try {
            User::destroy($id);
            $message = [
                'type' => 'success',
                'content' => 'Xóa người dùng thành công'
            ];
            return back()->with('message', $message);
        } catch (\Throwable $th) {
            $message = [
                'type' => 'error',
                'content' => $th->getMessage()
            ];
            return back()->with('message', $message);
        }
    }

    public function changeStatus($id, $status) {
        try {
            $status = ($status == 1) ? 0 : 1;
            User::where(['id' => $id])->update(['status' => $status]);
            $message = [
                'type' => 'success',
                'content' => 'Đổi trạng thái thành công'
            ];
            return back()->with('message', $message);
        } catch (\Throwable $th) {
            $message = [
                'type' => 'error',
                'content' => $th->getMessage()
            ];
            return back()->with('message', $message);
        }
    }

}
