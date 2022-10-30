<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use stdClass;

class CartController extends Controller
{
    //
    public function __construct()
    {
    }


    public function index()
    {
        $user       = Auth::user();
        if (empty($user)) {
            $message = session('message');
            return redirect()->route('web.home')->with('message', $message);;
        }
        $data['profile']  = Profile::where('user_id', $user->id)->first();

        $data['products'] = Cart::where('user_id', $user->id)->get();

        return view('web.cart.index', $data);
    }

    public function add()
    {
        $user = Auth::user();

        if (empty($user) || $user->role != 2) {
            $data = [
                'message' => 'login_please',
                'success' => false
            ];
        } elseif (empty(Request::post())) {
            $data = [
                'message' => 'Lỗi.',
                'success' => false
            ];
        } else {
            $product_id = Request::post('product_id');
            $product = Product::findOrFail($product_id);
            $old_cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();
            $quantity = 0;
            if (empty($old_cart)) {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $product->id;
                $cart->quantity =  $quantity = 1;
                $cart->save();
            } else {
                $quantity = ++$old_cart->quantity;
                $old_cart->save();
            }
            $count_product = Cart::where('user_id', $user->id)->count();
            $data = [
                'message'       => 'Thêm giỏ hàng thành công.',
                'count_product' => $count_product,
                'product'    => [
                    'id'          => $product->id,
                    'price'       => number_format($product->price_sell, 0) . 'đ/' . $product->unit_of_measure,
                    'quantity'    => $quantity,
                    'total_money' => number_format($quantity * $product->price_sell * $product->mass_default, 0) . 'đ'
                ],
                'success'       => true
            ];
        }
        return response()->json($data, 200);
    }
    public function minus()
    {
        $user = Auth::user();
        if (empty($user) || empty(Request::post())) {
            $data = [
                'message' => 'Lỗi.',
                'success' => false
            ];
        } else {
            $product_id = Request::post('product_id');
            $product = Product::findOrFail($product_id);
            $old_cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();
            $quantity = 0;
            if (empty($old_cart)) {
                $data = [
                    'message' => 'Không có sản phẩm này trong giỏ hàng.',
                    'success' => false
                ];
            } else {
                if ($old_cart->quantity > 1) {
                    $quantity = --$old_cart->quantity;
                    $old_cart->save();
                } else {
                    $old_cart->delete();
                }
            }
            $count_product = Cart::where('user_id', $user->id)->count();
            $data = [
                'message'       => 'Sửa giỏ hàng thành công.',
                'count_product' => $count_product,
                'product'    => [
                    'id'          => $product->id,
                    'price'       => number_format($product->price_sell, 0) . 'đ/' . $product->unit_of_measure,
                    'quantity'    => $quantity,
                    'total_money' => number_format($quantity * $product->price_sell * $product->mass_default, 0) . 'đ'
                ],
                'success'       => true
            ];
        }
        return response()->json($data, 200);
    }
    public function delete($product_id)
    {
        $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Xóa sản phẩm không thành công.'
            ];
        } else {
            Cart::where('user_id', $user->id)->where('product_id', $product_id)->delete();
            $message = [
                'type'    => 'success',
                'content' => 'Xóa sản phẩm thành công.'
            ];
        }
        return redirect()->route('web.cart')->with('message', $message);
    }
}
