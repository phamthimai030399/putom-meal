@extends('cms.layout.index')
@section('content')

    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                THÔNG TIN KHÁCH HÀNG
            </div>
            <div class="card-body">
                <p>Họ và tên: <strong>{{$oneItem->full_name}}</strong></p>
                <p>Số điện thoại: <strong>{{$oneItem->phone_number}}</strong></p>
                <p>Địa chỉ: <strong>{{$oneItem->address}}</strong></p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                DANH SÁCH ĐƠN HÀNG
                <div class="card-header-actions pr-1">
                    <a class="btn btn-info btn-sm" href="{{ url()->current() }}">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-reload') }}"></use>
                        </svg> Tải lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="get" action="">
                    <div class="form-group row">
                        <div class="col-7">
                            <input type="text" value="{{ Request::get('keyword') ?? '' }}" name="keyword"
                                class="form-control" placeholder="Từ khóa">
                        </div>
                        <div cslass="col-3">
                            <select name="status" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach (ORDER_STATUS as $key => $value)
                                    <option {{ Request::get('status') == $key ? 'selected' : '' }}
                                        value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th class="text-center w-5">ID</th>
                            <th>Mã đơn hàng</th>
                            <th class="text-center w-15">Thành tiền</th>
                            <th class="text-center w-15">Ghi chú</th>
                            <th class="text-center w-15">Trạng thái</th>
                            <th class="text-center w-15">Thông tin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($listItem))
                            @foreach ($listItem as $item)
                                <tr>
                                    <td class="text-center">{{ $item->id }}</td>
                                    <td><a href="{{ route('cms.order.detail', [$item->code]) }}">{{ $item->code }}</a>
                                    </td>
                                    <td>
                                        {{ number_format($item->details->sum('total_money'), 0) }}đ
                                    </td>
                                    <td>
                                        {{ $item->note }}
                                    </td>
                                    <td class="action">
                                        <p class="btn btn-status mb-0 btn-status-{{ colorOrderStatus($item->status) }}">
                                            {{ showOrderStatus($item->status) }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        Ngày tạo : {{ date('H:i d-m-Y', strtotime($item->created_at)) }}<br />
                                        Ngày sửa : {{ date('H:i d-m-Y ', strtotime($item->updated_at)) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $listItem->appends($condition)->links('cms.layout.panigation') }}
            </div>
        </div>
    </div>
@endsection
