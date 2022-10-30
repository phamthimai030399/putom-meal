@extends('web.layout.index')
@section('content')
    <main class="mb-3 py-5 bg-gray">
        <div class="container container-sm">
            <h2 class="p-3">Chi tiết đơn hàng: <strong>{{ $order->code }}</strong></h2>
            <div class="row m-0">
                <table class="table table-striped table-bordered datatable col-12">
                    <thead>
                        <tr>
                            <th class="text-center w-5">ID</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-center w-15">Số lượng</th>
                            <th class="text-center w-15">Khối lượng</th>
                            <th class="text-center w-15">Giá</th>
                            <th class="text-center w-15">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($order->details))
                            @foreach ($order->details as $item)
                            <tr>
                                <td class="text-center">{{ $item->product_id }}</td>
                                <td>{{ $item->product->title }}
                                </td>
                                <td class="text-right">
                                    {{ $item->amount }} {{$item->product->unit_of_sell}}
                                </td>
                                <td class="text-right">
                                    {{ $item->mass }} {{$item->product->unit_of_measure}}
                                </td>
                                <td class="text-right">
                                    {{ number_format($item->price, 0) }}đ/{{ $item->product->unit_of_measure }}
                                </td>
                                <td class="text-right font-weight-bold text-danger">
                                    {{ number_format($item->total_money, 0) }}đ
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
