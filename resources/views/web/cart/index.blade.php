@extends('web.layout.index')
@section('content')
    <main class="mb-3 py-5 bg-gray">
        <div class="container container-sm">
            <h2 class="p-3">Giỏ hàng</h2>
            @if (count($products) > 0)
                <div class="row m-0">
                    <p>Số tiền trong giỏ hàng là số tiền ước lượng. Số tiền bạn phải thanh toán thực tế sẽ được tính lại với
                        khối
                        lượng thực tế.</p>
                    <table class="table table-striped table-bordered datatable col-12">
                        <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Tên sản phẩm</th>
                                <th class="text-center w-15">Số lượng</th>
                                <th class="text-center w-15">Đơn vị bán</th>
                                <th class="text-center w-15">Giá</th>
                                <th class="text-center w-15">Thành tiền</th>
                                <th class="text-center w-15">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($products))
                                @foreach ($products as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->product->id }}</td>
                                        <td>{{ $item->product->title }}
                                        </td>
                                        <td class="text-right">
                                            <span class="btn-minus-cart"
                                                data-product-id="{{ $item->product->id }}">-</span>
                                            <span id="cart-quantity-product-{{ $item->product->id }}">
                                                {{ $item->quantity }}
                                            </span>
                                            <span class="btn-add-cart"
                                                data-product-id="{{ $item->product->id }}">+</span>
                                        </td>
                                        <td>
                                            {{ $item->product->unit_of_sell }}
                                        </td>
                                        <td class="text-right" id="cart-price-product-{{ $item->product->id }}">
                                            {{ number_format($item->product->price_sell, 0) }}đ/{{ $item->product->unit_of_measure }}
                                        </td>
                                        <td class="text-right font-weight-bold text-danger"
                                            id="cart-total-money-product-{{ $item->product->id }}">
                                            {{ number_format($item->quantity * $item->product->price_sell * $item->product->mass_default, 0) }}đ
                                        </td>
                                        <td class="action">
                                            <a
                                                href="{{ route('web.cart.delete', ['product_id' => $item->product_id]) }}">
                                                <i class="icofont-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <form action="{{ route('web.order.add') }}" method="POST" class="w-100">
                        <div class="row">

                            <div class="form-group col-12 col-md-4">
                                <label>Người nhận hàng <span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="full_name"
                                    value="{{ empty(old('full_name')) ? $profile->full_name : old('full_name') }}"
                                    type="text" placeholder="Người nhận hàng">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label>Số điện thoại <span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="phone_number"
                                    value="{{ empty(old('phone_number')) ? $profile->phone_number : old('phone_number') }}"
                                    type="text" placeholder="Số điện thoại">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label>Địa chỉ nhận hàng<span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="address"
                                    value="{{ empty(old('address')) ? $profile->address : old('address') }}" type="text"
                                    placeholder="Địa chỉ nhận hàng">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label>Ghi chú</label>
                                <input class="form-control" name="note" value="{{ old('note') }}" type="text"
                                    placeholder="Ghi chú">
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Đặt hàng</button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="w-100 bg-white text-green p-3">Không có sản phẩm nào trong giỏ hàng</div>
            @endif
        </div>

    </main>
@endsection
