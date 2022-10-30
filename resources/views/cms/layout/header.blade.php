<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-menu') }}"></use>
        </svg>
    </button><a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('image/icon-svg/coreui.svg#full') }}"></use>
        </svg></a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-menu') }}"></use>
        </svg>
    </button>
    <ul class="c-header-nav d-md-down-none">
        {{-- <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Xóa cache</a></li> --}}
    </ul>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"><svg class="c-icon">
                        <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-user') }}"></use>
                    </svg>

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <a class="dropdown-item" href="{{ route('cms.auth.changePassword') }}">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-lock-locked') }}"></use>
                    </svg>
                    Đổi mật khẩu
                </a>
                <a class="dropdown-item" href="{{ route('cms.auth.logout') }}">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-account-logout') }}"></use>
                    </svg>
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">
                <a href="{{ empty($button_back) ? url()->previous() : $button_back }}">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-backspace') }}"></use>
                    </svg>
                    Quay lại
                </a>
            </li>
        </ol>
    </div>
</header>