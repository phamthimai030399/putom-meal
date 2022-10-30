@extends('cms.layout.index')
@section('content')

    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                BÁO CÁO
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
                        <div class="col-6">
                            <label for="">Từ ngày</label>
                            <input type="date" value="{{ Request::get('start_time') ?? '' }}" name="start_time"
                                class="form-control" placeholder="Từ ngày">
                        </div>
                        <div class="col-6">
                            <label for="">Đến ngày</label>
                            <input type="date" value="{{ Request::get('end_time') ?? '' }}" name="end_time"
                                class="form-control" placeholder="Đến ngày">
                        </div>

                        <div class="col-12 mt-3">
                            <input type="submit" class="btn btn-primary" value="Lọc">
                        </div>
                    </div>
                </form>
                @if (!empty($listItem))
                    <div class="row">
                        <div class="col-6">
                            <span>Tổng số đơn hàng: </span>
                            <strong class="text-danger">{{ $count }}</strong>
                        </div>
                        <div class="col-12">
                            <span>Tổng tiền: </span>
                            <strong class="text-danger">{{ number_format($total_money, 0) }}đ</strong>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered datatable">
                        <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Mã đơn hàng</th>
                                <th class="text-center w-15">Khách hàng</th>
                                <th class="text-center w-15">Thành tiền</th>
                                <th class="text-center w-15">Ghi chú</th>
                                <th class="text-center w-15">Trạng thái</th>
                                <th class="text-center w-15">Thông tin</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($listItem as $item)
                                <tr>
                                    <td class="text-center">{{ $item->id }}</td>
                                    <td><a href="{{ route('cms.order.detail', [$item->code]) }}">{{ $item->code }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('cms.profile.detail', [$item->person->id]) }}">{{ $item->person->full_name }}</a>
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
                        </tbody>
                    </table>
                    {{ $listItem->appends($condition)->links('cms.layout.panigation') }}
                @endif
            </div>
        </div>
    </div>
@endsection
