<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="/image/icon-svg/coreui.svg#full"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="/image/icon-svg/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="index.html">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-speedometer') }}"></use>
                </svg>Dashboard</a></li>
        @if (in_array($role, [1, 3, 4]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link"
                    href="{{ route('cms.media') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-image') }}"></use>
                    </svg>Media</a>
            </li>
        @endif
        @if (in_array($role, [1]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.supplier.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-building') }}"></use>
                    </svg>
                    Quản lý nhà cung cấp
                </a>

            </li>
        @endif
        @if (in_array($role, [1, 4]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.category.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-library') }}"></use>
                    </svg>
                    Quản lý danh mục
                </a>

            </li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.product.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-basket') }}"></use>
                    </svg>
                    Quản lý sản phẩm
                </a>

            </li>
        @endif
        @if (in_array($role, [1, 5]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.order.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-cart') }}"></use>
                    </svg>
                    Quản lý đơn hàng
                </a>
            </li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.report') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-book') }}"></use>
                    </svg>
                    Báo cáo
                </a>
            </li>
        @endif
        @if (in_array($role, [1, 3]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.post.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-pen') }}"></use>
                    </svg>
                    Quản lý bài viết
                </a>

            </li>
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.menu.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-puzzle') }}"></use>
                    </svg>
                    Quản lý menu
                </a>

            </li>
        @endif
        @if (in_array($role, [1, 5]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.profile.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-user') }}"></use>
                    </svg>
                    Quản lý khách hàng
                </a>

            </li>
        @endif
        @if (in_array($role, [1]))
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link" href="{{ route('cms.user.list') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('/image/icon-svg/free.svg#cil-lock-locked') }}"></use>
                    </svg>
                    Quản lý tài khoản
                </a>

            </li>
        @endif

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 575px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 444px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
