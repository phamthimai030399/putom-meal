<header class="position-sticky">
    <div class="bg-green">
        <div class="py-3 container d-flex justify-content-between ">
            <a href="/" class="mr-3 my-n3 logo align-content-center d-none d-md-flex">
                <img src="{{ asset('image/logo-white.png') }}" alt="logo">
            </a>
            <div class="flex-fill text-center">
                <form action="{{ route('web.product.search') }}" method="GET"
                    class="col-12 col-md-8 p-0 mx-auto position-relative">
                    <input type="text" class="input-search w-100" name="p"
                        value="{{ empty($condition['p']) ? '' : $condition['p'] }}">
                    <button class="button-search d-flex align-content-center"><i class="icofont-search"></i></button>
                </form>
            </div>
            <div class="btn-group text-white {{ empty($user) ? 'd-none' : '' }}" id="header-login-success">
                <a class="btn text-white" href="{{ route('web.cart') }}">
                    <i class="icofont-cart-alt"></i>
                    @if (!empty($count_product_in_cart))
                        <div class="count-product-in-cart">{{ $count_product_in_cart }}</div>
                        @else
                        <div class="count-product-in-cart d-none"></div>
                    @endif
                </a>
                <button type="button" class="btn dropdown-toggle text-white" data-toggle="dropdown">
                    <i class="icofont-ui-user"></i>
                </button>
                <div class="dropdown-menu  dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('web.profile') }}">Sửa thông tin</a>
                    <a class="dropdown-item" href="{{ route('web.order.history') }}">Lịch sử mua hàng</a>
                    <a class="dropdown-item" href="{{ route('web.logout') }}">Đăng xuất</a>
                </div>

            </div>
            <div class="btn-group text-white  {{ empty($user) ? '' : 'd-none' }}" id="header-before-login">
                <button type="button" class="btn text-white" data-toggle="modal" data-target="#loginModal">
                    <i class="icofont-cart-alt"></i>
                </button>
                <button type="button" class="btn text-white" data-toggle="modal" data-target="#loginModal">
                    <i class="icofont-ui-user"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="menu-box d-none d-md-block">
        <nav class="container navbar navbar-expand-sm">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Danh mục</a>
                    <div class="dropdown-menu">
                        @foreach ($categories as $item)
                            <a class="dropdown-item"
                                href="{{ route('web.category.detail', [$item->slug]) }}">{{ $item->title }}</a>
                        @endforeach
                    </div>
                </li>
                @foreach ($menus as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url($item->link) }}">{{ $item->title }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
<div class="modal" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('web.login') }}" method="POST">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Đăng nhập</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-danger" id="login-fail-noti"></p>
                    <div class="form-group">
                        <label>Tài khoản</label>
                        <input class="form-control" required name="username" id="username" type="text"
                            placeholder="Tài khoản">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" required name="password" id="password" type="password"
                            placeholder="Mật khẩu">
                    </div>
                    <div class="form-group">
                        <a href="{{ route('web.register') }}" class="text-green"><strong><i>Đăng ký tài
                                    khoản</i></strong></a>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-login">Đăng nhập</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng lại</button>
                </div>
            </form>


        </div>
    </div>
</div>
