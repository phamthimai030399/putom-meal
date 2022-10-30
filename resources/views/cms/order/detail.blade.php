@extends('cms.layout.index')
@section('content')

    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                ĐƠN HÀNG -
                <span class="btn btn-status mb-0 btn-status-{{ colorOrderStatus($order->status) }}">
                    {{ showOrderStatus($order->status) }}
                </span>
                <div class="card-header-actions pr-1">
                    <a class="btn btn-info btn-sm" href="{{ url()->current() }}">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-reload') }}"></use>
                        </svg> Tải lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="col-12">
                        <i>Thông tin khách hàng</i>
                    </h4>
                    <div class="col-4">
                        <span>Khách hàng: </span>
                        <strong><a
                                href="{{ route('cms.profile.update', [$order->person->id]) }}">{{ $order->person->full_name }}</a></strong>
                    </div>
                    <div class="col-4">
                        <span>Số điện thoại: </span>
                        <strong>{{ $order->person->phone_number }}</strong>
                    </div>
                    <div class="col-4">
                        <span>Địa chỉ: </span>
                        <strong>{{ $order->person->address }}</strong>
                    </div>
                </div>
                <form class="row info mb-3" method="POST" action="{{ route('cms.order.changeStatus', [$order->id]) }}">
                    <h4 class="col-12">
                        <i>Thông tin nhận hàng</i>
                    </h4>
                    <div class="col-12 row">
                        <div class="col-4 mt-3 d-flex">
                            <span>Người nhận: </span>
                            <input class="text-bold flex-fill" type="text" {{ disabledInputOrder($order->status) }}
                                name="full_name" value="{{ $order->full_name }}">
                        </div>
                        <div class="col-4 mt-3 d-flex">
                            <span>Số điện thoại: </span>
                            <input class="text-bold flex-fill" type="text" {{ disabledInputOrder($order->status) }}
                                name="phone_number" value="{{ $order->phone_number }}">
                        </div>
                        <div class="col-4 mt-3 d-flex">
                            <span>Địa chỉ: </span>
                            <input class="text-bold flex-fill" type="text" {{ disabledInputOrder($order->status) }}
                                name="address" value="{{ $order->address }}">
                        </div>
                        <div class="col-12 mt-3 d-flex">
                            <span>Ghi chú: </span>
                            <input class="text-bold flex-fill" type="text" {{ disabledInputOrder($order->status) }}
                                name="note" value="{{ $order->note }}">
                        </div>
                    </div>
                    <table class="mt-3 table table-striped table-bordered datatable">
                        <thead>
                            <tr>
                                <th class="text-center w-5">ID sản phẩm</th>
                                <th class="text-center">Ảnh sản phẩm</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center w-15" colspan="2">Số lượng</th>
                                <?php if ($order->status != 'pending'):?>
                                <th class="text-center w-15" colspan="2">Khối lượng</th>
                                <?php endif;?>
                                <th class="text-center w-15">Giá</th>
                                <th class="text-center w-15">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($order->details))
                                @foreach ($order->details as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->product->id }}</td>
                                        <td><img src="{{ $item->product->thumbnail }}" class="img-fluid d-block"
                                                id="lbl_img" width="100px"></td>
                                        <td>
                                            {{ $item->product->title }}
                                        </td>
                                        <td>
                                            <input class="input_amount" data-id="{{ $item->id }}" type="number"
                                                {{ noActionOrderStatus($order->status) ? 'disabled' : '' }}
                                                name="detail[{{ $item->id }}][amount]"
                                                value="{{ $item->amount }}">
                                        </td>
                                        <td>
                                            {{$item->product->unit_of_sell }}
                                        </td>
                                        <td style="{{ $order->status == 'pending' ? 'display: none' : '' }}">
                                            <input class="input_mass" id="mass_{{ $item->id }}" data-id="{{ $item->id }}" data-mass-default="{{ $item->product->mass_default }}"  type="text"
                                                {{ noActionOrderStatus($order->status) ? 'disabled' : '' }}
                                                name="detail[{{ $item->id }}][mass]" value="{{ $item->mass }}">
                                        </td>
                                        <td style="{{ $order->status == 'pending' ? 'display: none' : '' }}">
                                            {{$item->product->unit_of_measure }}
                                        </td>

                                        <td class="text-right" id="price_{{ $item->id }}" data-price="{{ $item->price }}">
                                            {{ number_format($item->price, 0) }}đ/{{$item->product->unit_of_measure }}
                                        </td>
                                        <td class="text-right" id="total_money_{{ $item->id }}">
                                            {{ number_format($item->total_money, 0) }}đ
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="col-12 text-right">
                        <span>Tổng: </span>
                        <h5 class="text-danger d-inline">{{ number_format($order->details->sum('total_money'), 0) }}đ
                        </h5>
                    </div>
                    @if (!noActionOrderStatus($order->status))
                        <div class="col-12 mt-3 text-right">
                            <button
                                class="btn btn-sm btn-status-{{ colorOrderStatus(nextOrderStatus($order->status)) }}">
                                {{ showOrderStatus(nextOrderStatus($order->status)) }}
                            </button>
                            <a class="btn btn-danger btn-sm" href="{{ route('cms.order.cancel', [$order->id]) }}"
                                onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');">Hủy</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script src="{{url('cms/js/order.js')}}"></script>
@endsection
