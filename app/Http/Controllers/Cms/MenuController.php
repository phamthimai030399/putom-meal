<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('parent_id', '=', 0)->orderBy('order')->get();
        $allMenus = Menu::pluck('title', 'id')->all();
        return view('cms.menu.index', compact('menus', 'allMenus'));
    }

    public function add()
    {
        $validator = Validator::make(Request::all(), [
            'title' => 'required',
            'link'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $input = Request::post();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        $menu_max_order = Menu::where('parent_id', $input['parent_id'])->orderBy('order', 'DESC')->first();
        $input['order'] = empty($menu_max_order) ? 1 : $menu_max_order->order + 1;
        Menu::insert($input);
        $message = [
            'type' => 'success',
            'content' => 'CẬP NHẬT THÀNH CÔNG'
        ];
        return back()->with('message', $message);
    }

    public function update($id)
    {
        View::share('button_back', route('cms.menu.index'));
        $this_menu = Menu::findOrFail($id);
        if (empty(Request::post())) { 
            $menus = Menu::where('parent_id', '=', 0)->get();
            $allMenus = Menu::pluck('title', 'id')->all();
            return view('cms.menu.update', compact('this_menu', 'menus', 'allMenus'));
        }
        else {
            $validator = Validator::make(Request::all(), [
                'title' => 'required',
                'link'  => 'required',
            ]);
    
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $input = Request::post();
            $menu['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
            $menu['title'] = $input['title'];
            $menu['link'] = $input['link'];
            Menu::updateOrInsert(['id' => $id], $menu);
            $message = [
                'type' => 'success',
                'content' => 'CẬP NHẬT THÀNH CÔNG'
            ];
            return back()->with('message', $message);
        }
    }

    
    public function delete($id)
    {
        try {
            Menu::destroy($id);
            $message = [
                'type' => 'success',
                'content' => 'XÓA THÀNH CÔNG'
            ];
        } catch (\Throwable $th) {
            $message = [
                'type' => 'error',
                'content' => $th->getMessage()
            ];
        }
        return back()->with('message', $message);
    }
    public function up($id)
    {
        $this_menu = Menu::findOrFail($id);
        $ahead_menu = Menu::where('order', '<', $this_menu->order)->orderBy('order', 'DESC')->first();
        if(!empty($ahead_menu)) {
            try {
                DB::BeginTransaction();
                $temp = $this_menu->order;
                $this_menu->order = $ahead_menu->order;
                $ahead_menu->order = $temp;
                $this_menu->save();
                $ahead_menu->save();
                DB::Commit();
                $message = [
                    'type' => 'success',
                    'content' => 'Đổi vị trí thành công'
                ];
            } catch (\Throwable $th) {
                DB::RollBack();
                $message = [
                    'type' => 'error',
                    'content' => $th->getMessage()
                ];
            }
        } else {
            $message = [
                'type' => 'error',
                'content' => 'Menu hiện tại đã ở vị trí đầu tiên'
            ];
        }
        return back()->with('message', $message);
    }
    
}
