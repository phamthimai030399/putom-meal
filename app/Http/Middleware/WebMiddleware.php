<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Menu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class WebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $menu = Menu::where('parent_id', '=', 0)->orderBy('order')->get();
        View::share('menus', $menu);
        $categories = Category::where('category_parent_id', '=', 0)->where('status', '=', 1)->get();
        View::share('categories', $categories);
        $user = Auth::user();
        if (!empty($user) && $user->role == 2) {
            View::share('user', $user);
            $count_product_in_cart = Cart::where('user_id', $user->id)->count();
            View::share('count_product_in_cart', $count_product_in_cart);
        }
        return $next($request);
    }
}
