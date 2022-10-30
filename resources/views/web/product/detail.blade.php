@extends('web.layout.index')
@section('content')
    <main class="mb-3 detail-product py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    {{ showThumbnail($oneItem->thumbnail, 500, 500, 'w-100') }}
                </div>
                <div class="col-12 col-md-6">
                    <h3>
                        {{ $oneItem->title }} 
                        @if ($oneItem->price_sell < $oneItem->price_origin)
                            <span class="badge badge-warning">-{{ round(100 - ($oneItem->price_sell / $oneItem->price_origin) * 100, 1) }}%</span>
                        @endif
                    </h3>
                   
                    <h5><a href="{{ route('web.supplier.detail', [$oneItem->supplier->slug]) }}">{{ $oneItem->supplier->title }}</a></h5>
                    <p>{{ $oneItem->unit_of_sell }}</p>
                    <p>{!! $oneItem->description !!}</p>
                    <div>
                        <strong>{{ number_format($oneItem->price_sell, 0) }}đ/{{ $oneItem->unit_of_measure }}</strong>
                        <del>{{ number_format($oneItem->price_origin, 0) }}đ/{{ $oneItem->unit_of_measure }}</del>
                    </div>
                    <div class="price">
                        {{ number_format($oneItem->price_sell * $oneItem->mass_default, 0) }}đ
                    </div>
                    <div>
                        <button class="btn btn-add-cart" data-product-id="{{ $oneItem->id }}">
                            <i class="fas fa-cart-plus"></i>
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
