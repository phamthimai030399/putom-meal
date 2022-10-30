<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['condition'] = [];
        if (!empty(Request::get('keyword'))) {
            $data['condition'] = array_merge($data['condition'], array('keyword' => Request::get('keyword')));
        };
        $listItem = Profile::where('full_name', 'LIKE', '%' . toNormal(Request::get('keyword')) . '%')
                            ->orWhere('phone_number', 'LIKE', '%' . toNormal(Request::get('keyword')) . '%')
                            ->orderBy('updated_at', 'DESC')->paginate(20);
        $data['listItem'] = $listItem;
        return view('cms.profile.index', $data);
    }

    public function update($id = 0)
    {
        View::share('button_back', route('cms.profile.list'));
        $data = [];
        $data['oneItem']   = $oneItem = Profile::findOrFail($id);
        if (!empty(Request::post())) {

            $validator = Validator::make(Request::all(), [
                'full_name'    => 'required',
                'phone_number' => 'required|unique:profile,phone_number,' . $id . ',id',
                'address'      => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $post_data  = Request::post();

            try {

                DB::BeginTransaction();
                Profile::updateOrInsert(['id' => $id], $post_data);
                DB::Commit();
                $message = [
                    'type'    => 'success',
                    'content' => 'CẬP NHẬT THÀNH CÔNG'
                ];
                return redirect()->route('cms.profile.list')->with('message', $message);
            } catch (\Exception $ex) {
                DB::RollBack();
                $message = [
                    'type'    => 'error',
                    'content' => 'CẬP NHẬT THẤT BẠI'
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        return view('cms.profile.update', $data);
    }

    public function detail($profile_id)
    {
        $data['oneItem'] = Profile::findOrFail($profile_id);
        $condition = [];
        $data['condition'] = [];
        if (null !== (Request::get('status'))) {
            $condition[] = ['status', Request::get('status')];
            $data['condition'] = array_merge($data['condition'], array('status' => Request::get('status')));
        }
        if (!empty(Request::get('keyword'))) {
            $condition[] = ['code', 'LIKE', '%' . Request::get('keyword') . '%'];
            $data['condition'] = array_merge($data['condition'], array('keyword' => Request::get('keyword')));
        }
        $listItem = Order::where($condition)->where('profile_id', $profile_id)->orderBy('created_at', 'DESC')->paginate(20);
        $data['listItem'] = $listItem;
        return view('cms.profile.detail', $data);
    }

}
