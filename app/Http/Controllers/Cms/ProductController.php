<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $condition = [];
        $data['condition'] = [];
        if (null !== (Request::get('status'))) {
            $condition[] = ['status', Request::get('status')];
            $data['condition'] = array_merge($data['condition'], array('status' => Request::get('status')));
        }
        if (!empty(Request::get('keyword'))) {
            $condition[] = ['title', 'LIKE', '%' . toNormal(Request::get('keyword')) . '%'];
            $data['condition'] = array_merge($data['condition'], array('keyword' => Request::get('keyword')));
        }
        if (!empty(Request::get('category_id'))) {
            $condition[] = ['category_id', Request::get('category_id')];
        }
        if (!empty(Request::get('supplier_id'))) {
            $condition[] = ['supplier_id', Request::get('supplier_id')];
        }
        $data['allCategory'] = Category::getTree();
        $data['allSupplier'] = Supplier::all();
        $listItem = Product::where($condition)->orderBy('updated_at', 'DESC')->paginate(20);
        $data['listItem'] = $listItem;
        return view('cms.product.index', $data);
    }

    public function add()
    {
        View::share('button_back', route('cms.product.list'));

        $data = [];
        if (!empty(Request::post())) {
            $validator = Validator::make(Request::all(), [
                'title'      => 'required',
                'slug'       => 'required|unique:product',
                'thumbnail'  => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $post_data = Request::post();
            $data['created_at'] = new \DateTime();

            try {
                DB::BeginTransaction();
                $newPost = Product::create($post_data);
                DB::Commit();
                $message = [
                    'type' => 'success',
                    'content' => 'THÊM MỚI THÀNH CÔNG'
                ];
                return redirect()->route('cms.product.list')->with('message', $message);
            } catch (\Exception $ex) {
                DB::RollBack();
                $message = [
                    'type' => 'error',
                    'content' => $ex->getMessage()
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        $data['allCategory'] = Category::getTree();
        $data['allSupplier'] = Supplier::all();
        return view('cms.product.add', $data);
    }

    public function update($id = 0)
    {
        View::share('button_back', route('cms.product.list'));
        $data = [];
        $data['oneItem']   = $oneItem = Product::findOrFail($id);
        $data['allCategory'] = Category::getTree();
        $data['allSupplier'] = Supplier::all();
        if (!empty(Request::post())) {

            $validator = Validator::make(Request::all(), [
                'title'      => 'required',
                'slug'       => 'required|unique:product,slug,' . $id . ',id',
                'thumbnail'  => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $post_data = Request::post();

            try {

                DB::BeginTransaction();
                Product::updateOrInsert(['id' => $id], $post_data);
                DB::Commit();
                $message = [
                    'type' => 'success',
                    'content' => 'CẬP NHẬT THÀNH CÔNG'
                ];
                return redirect()->route('cms.product.list')->with('message', $message);
            } catch (\Exception $ex) {
                DB::RollBack();
                $message = [
                    'type' => 'error',
                    'content' => 'CẬP NHẬT THẤT BẠI'
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        return view('cms.product.update', $data);
    }

    public function delete($id)
    {
        try {

            DB::BeginTransaction();
            Product::destroy($id);
            DB::Commit();
            $message = [
                'type' => 'success',
                'content' => 'XÓA THÀNH CÔNG'
            ];
        } catch (\Exception $ex) {
            DB::RollBack();
            $message = [
                'type' => 'error',
                'content' => 'XÓA KHÔNG THÀNH CÔNG'
            ];
        }

        return back()->with('message', $message);
    }

    public function changeStatus($id = 0, $status = 0)
    {

        $status = ($status == 1) ? 0 : 1;
        Product::where(['id' => $id])->update(['status' => $status]);
        $message = [
            'type' => 'success',
            'content' => 'CẬP NHẬT THÀNH CÔNG'
        ];
        return back()->with('message', $message);
    }
}
