@extends('web.layout.index')
@section('content')
    <main class="mb-3 py-5 bg-gray">
        <div class="container container-sm">
            <h2 class="p-3">Lịch sử mua hàng</h2>
            @if (count($orders) > 0)
                <div class="row m-0">
                    <table class="table table-striped table-bordered datatable col-12">
                        <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Mã đơn hàng</th>
                                <th class="text-center w-15">Thành tiền</th>
                                <th class="text-center w-15">Ghi chú</th>
                                <th class="text-center w-15">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($orders))
                                @foreach ($orders as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td>
                                            <a href="{{ route('web.order.detail', [$item->code]) }}">
                                                {{ $item->code }}
                                            </a>
                                        </td>
                                        <td class="text-right">
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
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $orders->links('web.layout.panigation') }}
                </div>
            @else
                <div class="w-100 bg-white text-green p-3">Không có sản phẩm nào trong giỏ hàng</div>
            @endif
        </div>

    </main>
@endsection
