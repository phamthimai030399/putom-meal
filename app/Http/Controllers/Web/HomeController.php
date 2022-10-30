<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;

class HomeController extends Controller
{


    public function index()
    {
        
        $data['categories_home'] = Category::where('status', 1)
        ->has('products', '>=', 5)
        ->get()
        ->map(function ($cate) {
            $cate->setRelation('products', $cate->products->take(5));
            return $cate;
        });
        return view('web.home.index', $data);
    }
}
