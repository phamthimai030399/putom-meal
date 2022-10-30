@extends('web.layout.index')
@section('content')
    <main class="mb-3 py-5 bg-gray">
        <div class="container container-sm">
            <h2 class="p-3">Thông tin tài khoản</h2>
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="{{ route('web.update-profile') }}" method="POST" class="w-100">
                            <div class="form-group">
                                <label>Họ và tên <span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="full_name"
                                    value="{{ empty(old('full_name')) ? $profile->full_name : old('full_name') }}" type="text"
                                    placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại <span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="phone_number"
                                    value="{{ empty(old('phone_number')) ? $profile->phone_number : old('phone_number') }}" type="text"
                                    placeholder="Số điện thoại">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ <span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="address"
                                    value="{{ empty(old('address')) ? $profile->address : old('address') }}" type="text"
                                    placeholder="Địa chỉ">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                            </div>
                    </form>
                </div>
                <div class="col-12 col-md-6">
                    <form action="{{ route('web.change-password') }}" method="POST" class="w-100">
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
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
