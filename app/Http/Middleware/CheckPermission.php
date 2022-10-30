<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CheckPermission
{
    //biến này để phân quyền theo role
    private static $permission = [
        1 => [
            'name' => 'Admin',
            'allow' => [

            ]
        ],
        2 => [
            'name' => 'Khách hàng',
            'allow' => [

            ]
        ],
        3 => [
            'name' => 'Quản trị nội dung',
            'allow' => [
                'dashboard',
                'cms.auth.changePassword',
                'cms.media',
                'cms.post.list',
                'cms.post.add',
                'cms.post.update',
                'cms.post.delete',
                'cms.post.changeStatus',
                'cms.menu.index',
                'cms.menu.add',
                'cms.menu.update',
                'cms.menu.delete',
                'cms.menu.up',
            ]
        ],
        4 => [
            'name' => 'Quản lý sản phẩm',
            'allow' => [
                'dashboard',
                'cms.auth.changePassword',
                'cms.media',
                'cms.product.list',
                'cms.product.add',
                'cms.product.update',
                'cms.product.delete',
                'cms.product.changeStatus',
                'cms.category.list',
                'cms.category.add',
                'cms.category.update',
                'cms.category.delete',
                'cms.category.changeStatus',
            ]
        ],
        5 => [
            'name' => 'Nhân viên bán hàng',
            'allow' => [
                'dashboard',
                'cms.auth.changePassword',
                'cms.order.list',
                'cms.order.detail',
                'cms.order.changeStatus',
                'cms.order.cancel',
                'cms.profile.list',
                'cms.profile.add',
                'cms.profile.update',
                'cms.profile.detail',
                'cms.report',
            ]
        ],
        
    ];
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        $role = Auth::user()->role;
        if ($role == 2) {
            return redirect()->route('cms.auth.login');
        }
        $permission = self::getPermission();
        if ($role != 1 && !in_array(Route::currentRouteName(), $permission[$role]['allow'])) {
            echo "not allow";
            exit();
        }
        View::share('role', $role);
        return $next($request);
    }
    public static function getPermission() {
        return self::$permission;
    }
}
