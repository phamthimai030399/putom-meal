<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    //
    public function __construct()
    {
    }


    public function detail($category_slug, $slug)
    {
        $data['oneItem'] = Product::where('slug', $slug)->first();
        if (empty($data['oneItem'])) {
            abort(404);
        }
        return view('web.product.detail', $data);
    }

    public function search()
    {
        $data['condition'] = Request::input();
        $query = Product::where('title', 'LIKE', '%' . toNormal($data['condition']['p']) . '%');
        if (!empty($data['condition']['category'])) {
            $query->where('category_id', $data['condition']['category']);
        }
        if (!empty($data['condition']['order'])) {
            $query->orderBy($data['condition']['order'], 'ASC');
        }
        $data['products'] = $query->get();
        return view('web.product.search', $data);
    }
}
