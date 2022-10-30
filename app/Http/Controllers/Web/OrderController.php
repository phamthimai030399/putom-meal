<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class OrderController extends Controller
{
    //
    public function __construct()
    {
    }

    public function add()
    {
        $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Bạn chưa đăng nhập.'
            ];
            return redirect()->route('web.home')->with('message', $message);
        } else {
            $validator = Validator::make(Request::all(), [
                'full_name'    => 'required',
                'phone_number' => 'required',
                'address'      => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            try {
                DB::BeginTransaction();
                $post_data = Request::post();
                $products = Cart::where('user_id', $user->id)->get();
                $profile = Profile::where('user_id', $user->id)->first();
                $order = new Order();
                $order->profile_id = $profile->id;
                $order->code = self::makeCode($post_data['phone_number']);
                $order->full_name = $post_data['full_name'];
                $order->phone_number = $post_data['phone_number'];
                $order->address = $post_data['address'];
                $order->note = $post_data['note'];
                $order->status = startOrderStatus();
                $order->save();
                $total_money = 0;
                foreach($products as $item) {
                    $order_detail = new OrderDetail();
                    $order_detail->order_id = $order->id;
                    $order_detail->product_id = $item->product_id;
                    $order_detail->amount = $item->quantity;
                    $order_detail->mass = $item->quantity * $item->product->mass_default;
                    $order_detail->price = $item->product->price_sell;
                    $order_detail->total_money = $order_detail->mass *  $order_detail->price;
                    $total_money += $order_detail->total_money;
                    $order_detail->save();
                }
                $order->total_money = $total_money;
                $order->save();
                Cart::where('user_id', $user->id)->delete();
                DB::Commit();
                $message = [
                    'type'    => 'success',
                    'content' => 'Đặt hàng thành công.'
                ];
                return redirect()->route('web.home')->with('message', $message);
            } catch (\Throwable $th) {
                DB::RollBack();
                $message = [
                    'type'    => 'error',
                    'content' => 'Đặt hàng không thành công.'
                ];
                return back()->with('message', $message)->withInput();
            }
        }
        
    }
    function makeCode($value)
    {
        $hash = Hash::make($value);
        $text = substr($hash, -10);
        $text = str_replace('/', 'C', $text);
        $result = strtoupper($text);
        return $result;
    }
    public function history() {
        $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Bạn chưa đăng nhập.'
            ];
            return redirect()->route('web.home')->with('message', $message);
        } else {
            $data['profile'] = Profile::where('user_id', $user->id)->first();
            $data['orders'] = Order::where('profile_id', $data['profile']->id)->orderBy('created_at', 'DESC')->paginate(10);
            return view('web.order.history', $data);
        }
    } 

    public function detail($code) {
        $user = Auth::user();
        if (empty($user)) {
            $message = [
                'type'    => 'error',
                'content' => 'Bạn chưa đăng nhập.'
            ];
            return redirect()->route('web.home')->with('message', $message);
        } else {
            try {
                $data['profile'] = Profile::where('user_id', $user->id)->first();
                $data['order'] = Order::where('profile_id', $data['profile']->id)->where('code', $code)->first();
                return view('web.order.detail', $data);
            } catch (\Throwable $th) {
                return redirect()->route('web.home');
            }
        }
    } 

}
