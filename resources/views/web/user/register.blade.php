@extends('web.layout.index')
@section('content')
    <main class="mb-3 py-5 bg-gray">
        <div class="container container-sm">
            <h2 class="p-3">Đăng ký tài khoản</h2>
            <div class="row">
                <form action="{{ route('web.register') }}" method="POST" class="w-50 mx-auto">
                        <div class="form-group">
                            <label>Username <span class="text-danger">(*)</span></label>
                            <input class="form-control" required name="username"
                                value="{{ old('username') }}" type="text"
                                placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu <span class="text-danger">(*)</span></label>
                            <input class="form-control" required name="password"
                                value="{{ old('password') }}" type="password"
                                placeholder="Mật khẩu">
                        </div>
                        <div class="form-group">
                            <label>Nhắc lại mật khẩu <span class="text-danger">(*)</span></label>
                            <input class="form-control" required name="re_password"
                                value="{{ old('re_password') }}" type="password"
                                placeholder="Nhắc lại mật khẩu">
                        </div>
                        <div class="form-group">
                            <label>Họ và tên <span class="text-danger">(*)</span></label>
                            <input class="form-control" required name="full_name"
                                value="{{ old('full_name') }}" type="text"
                                placeholder="Họ và tên">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại <span class="text-danger">(*)</span></label>
                            <input class="form-control" required name="phone_number"
                                value="{{ old('phone_number') }}" type="text"
                                placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ <span class="text-danger">(*)</span></label>
                            <input class="form-control" required name="address"
                                value="{{ old('address') }}" type="text"
                                placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                </form>
            </div>
        </div>

    </main>
@endsection
