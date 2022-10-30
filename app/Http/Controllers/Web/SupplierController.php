<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //
    public function __construct()
    {
    }


    public function detail($slug)
    {
        $data['oneItem'] = Supplier::where('slug', $slug)->where('status', 1)->first();
        if (empty($data['oneItem'])) {
            abort(404);
        }
        $data['products'] = Product::where('status', 1)->where('supplier_id', $data['oneItem']->id)->whereHas('category', function($query) {
            $query->where('status', 1);
        })->get();
        return view('web.supplier.index', $data);
    }
}
