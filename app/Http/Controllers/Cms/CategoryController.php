<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $condition         = [];
        $data['condition'] = [];
        if (null !== (Request::get('status'))) {
            $condition[]       = ['status', Request::get('status')];
            $data['condition'] = array_merge($data['condition'], array('status' => Request::get('status')));
        }
        if (!empty(Request::get('keyword'))) {
            $condition[]       = ['title', 'LIKE', '%' . toNormal(Request::get('keyword')) . '%'];
            $data['condition'] = array_merge($data['condition'], array('keyword' => Request::get('keyword')));
        }
        $listItem         = Category::where($condition)->paginate(20);
        $data['listItem'] = $listItem;
        return view('cms.category.index', $data);
    }

    public function add()
    {
        View::share('button_back', route('cms.category.list'));
        $data = [];
        if (!empty(Request::post())) {
            $validator = Validator::make(Request::all(), [
                'title'              => 'required',
                'slug'               => 'required|unique:category',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(Request::all());
            }

            $post_data = self::converData(Request::post());
            try {
                $test = Category::create($post_data);
                $message = [
                    'type'    => 'success',
                    'content' => 'Thêm mới thành công.'
                ];
                return redirect()->route('cms.category.list')->with('message', $message);
            } catch (\Exception $ex) {
                $message = [
                    'type'    => 'error',
                    'content' => 'Thêm mới thất bại'
                ];
                return back()->with('message', $message)->withInput(Request::all());
            }
        }
        $data['allCategoryTree'] = Category::getTree();
        return view('cms.category.add', $data);
    }

    public function update($id = 0)
    {
        View::share('button_back', route('cms.category.list'));
        $data            = [];
        $data['oneItem'] = Category::findOrFail($id);
        $data['allCategoryTree'] = Category::getTree();

        if (!empty(Request::post())) {
            $validator = Validator::make(Request::all(), [
                'title' => 'required',
                'slug'  => 'required|unique:category,slug,' . $id . ',id',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $post_data = Request::post();
            $post_data = self::converData(Request::post());
            try {
                Category::updateOrInsert(['id' => $id], $post_data);
                $message = [
                    'type'    => 'success',
                    'content' => 'CẬP NHẬT THÀNH CÔNG'
                ];
                return redirect()->route('cms.category.list')->with('message', $message);
            } catch (\Exception $ex) {
                $message = [
                    'type'    => 'error',
                    'content' => 'CẬP NHẬT THẤT BẠI'
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        return view('cms.category.update', $data);
    }

    public function delete($id)
    {
        try {
            Category::destroy($id);
            $message = [
                'type'    => 'success',
                'content' => 'XÓA THÀNH CÔNG'
            ];
        } catch (\Exception $ex) {
            $message = [
                'type'    => 'error',
                'content' => 'XÓA KHÔNG THÀNH CÔNG'
            ];
        }

        return back()->with('message', $message);
    }

    public function changeStatus($id = 0, $status = 0)
    {

        $status = ($status == 1) ? 0 : 1;
        Category::where(['id' => $id])->update(['status' => $status]);
        $message = [
            'type' => 'success',
            'content' => 'CẬP NHẬT THÀNH CÔNG'
        ];
        return back()->with('message', $message);
    }

    public function converData($data)
    {
        $data['category_parent_id'] = isset($data['category_parent_id']) ? $data['category_parent_id'] : 0;
        return $data;
    }
}
