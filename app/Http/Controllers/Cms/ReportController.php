<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class ReportController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $condition = [['status', 'completed']];
        $data['condition'] = [];
        if (!empty(Request::get('start_time'))) {
            $condition[] = ['created_at', '>=', date('Y-m-d 00:00:00', strtotime(Request::get('start_time')))];
            $data['condition'] = array_merge($data['condition'], array('start_time' => Request::get('start_time')));
        }
        if (!empty(Request::get('end_time'))) {
            $condition[] = ['created_at', '<=', date('Y-m-d 23:59:59', strtotime(Request::get('end_time')))];
            $data['condition'] = array_merge($data['condition'], array('end_time' => Request::get('end_time')));
        }
        $listItem = !empty(Request::get('start_time')) && !empty(Request::get('end_time')) ? Order::where($condition)->orderBy('created_at', 'DESC')->paginate(20) : [];
        $data['listItem'] = $listItem;
        $data['count'] = Order::where($condition)->count();
        $data['total_money'] = Order::where($condition)->sum('total_money');

        return view('cms.report.index', $data);
    }

    
    
}

