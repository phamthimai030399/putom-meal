<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $condition = [];
        $data['condition'] = [];
        $query = Order::orderBy('created_at', 'DESC');
        if (null !== (Request::get('status'))) {
            $condition[] = ['status', Request::get('status')];
            $query->where('status', Request::get('status'));
            $data['condition'] = array_merge($data['condition'], array('status' => Request::get('status')));
        }
        if (!empty(Request::get('keyword'))) {
            $query->where(function($q) {
                $q->where('code', 'LIKE', '%' . Request::get('keyword') . '%');
                $q->orWhereHas('person', function (Builder $queryBuilder) {
                    $queryBuilder->where('phone_number', 'LIKE', '%' . Request::get('keyword') . '%');
                    $queryBuilder->orWhere('full_name', 'LIKE', '%' . Request::get('keyword') . '%');
                });

            });
            $data['condition'] = array_merge($data['condition'], array('keyword' => Request::get('keyword')));
        }
        $listItem = $query->paginate(20);
        $data['listItem'] = $listItem;
        return view('cms.order.index', $data);
    }

    public function detail($code)
    {
        View::share('button_back', route('cms.order.list'));

        $data['order'] = Order::where('code', $code)->first();
        return view('cms.order.detail', $data);
    }

    public function changeStatus($id)
    {
        $order = Order::findOrFail($id);
        try {
            DB::BeginTransaction();
            $data = (object) Request::post();
            $order->full_name = empty($data->full_name) ? $order->full_name :  $data->full_name;
            $order->phone_number = empty($data->phone_number) ? $order->phone_number :  $data->phone_number;
            $order->address = empty($data->address) ? $order->address :  $data->address;
            $order->note = empty($data->note) ? $order->note :  $data->note;
            $order->status = nextOrderStatus($order->status);
            $total_money = 0;
            foreach($data->detail as $key => $value) {
                $order_detail = OrderDetail::findOrFail($key);
                $order_detail->amount = $value['amount'];
                $order_detail->mass = (float)$value['mass'];
                $order_detail->total_money = $order_detail->mass * $order_detail->price;
                $total_money += $order_detail->total_money;
                $order_detail->save();
            } 
            $order->total_money = $total_money;
            $order->save();
            DB::Commit();
            $message = [
                'type' => 'success',
                'content' => 'CHUYỂN TRẠNG THÁI ĐƠN HÀNG THÀNH CÔNG'
            ];
            return redirect()->route('cms.order.detail', [$order->code])->with('message', $message);
        } catch (\Exception $ex) {
            DB::RollBack();
            $message = [
                'type' => 'error',
                'content' => $ex->getMessage()
            ];
            return back()->with('message', $message);
        }
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        try {
            $order->status = getOrderStatusCanceled();
            $order->save();
            $message = [
                'type' => 'success',
                'content' => 'HỦY ĐƠN HÀNH THÀNH CÔNG'
            ];
            return redirect()->route('cms.order.detail', [$order->code])->with('message', $message);
        } catch (\Exception $ex) {
            $message = [
                'type' => 'error',
                'content' => $ex->getMessage()
            ];
            return back()->with('message', $message);
        }
        
    }

    
}

