@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <form method="post" action="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><strong>Thêm mới</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tài khoản <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="username" value="{{ old('username') }}"
                                            type="text" placeholder="Tài khoản">
                                    </div>
                                    <div class="form-group">
                                        <label>Quyền<span class="text-danger">(*)</span></label>
                                        <select class="form-control select2 category" name="role">
                                            @foreach ($permission as $key => $item)
                                            @if ($key != 2)
                                                @if (!empty(old('role')) && $key == old('role'))
                                                    <option value="{{ $key }}" selected="selected">
                                                        {{ $item['name'] }}</option>
                                                @else
                                                    <option value="{{ $key }}">{{ $item['name'] }}
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu<span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="password" value="{{ old('password') }}"
                                            type="password" placeholder="Mật khẩu">
                                    </div>
                                    <div class="form-group">
                                        <label>Nhắc lại mật khẩu <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="re_password" value="{{ old('re_password') }}"
                                        type="password" placeholder="Nhắc lại mật khẩu">
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
