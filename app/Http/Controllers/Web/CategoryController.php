<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
    }


    public function detail($slug)
    {
        $data['oneItem'] = Category::where('slug', $slug)->where('status', 1)->first();
        if (empty($data['oneItem'])) {
            abort(404);
        }
        $data['products'] = Product::where('status', 1)->where('category_id', $data['oneItem']->id)->whereHas('supplier', function($query) {
            $query->where('status', 1);
        })->get();
        return view('web.category.index', $data);
    }
}
