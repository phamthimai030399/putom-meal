@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <form method="post" action="{{ route('cms.profile.update', ['id' => $oneItem->id]) }}">
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header">
                            <p>CHỈNH SỬA PROFILE</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Họ và tên <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="full_name"
                                            value="{{ old('full_name', $oneItem->full_name) }}" type="text"
                                            placeholder="Họ và tên">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="phone_number"
                                            value="{{ old('phone_number', $oneItem->phone_number) }}" type="text"
                                            placeholder="Số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="address"
                                            value="{{ old('address', $oneItem->address) }}" type="text"
                                            placeholder="Địa chỉ">
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
