<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
    }


    public function detail( $slug)
    {
        $data['oneItem'] = Post::where('slug', $slug)->where('status', 1)->first();
        if (empty($data['oneItem'])) {
            abort(404);
        }
        return view('web.post.detail', $data);
    }
}
