<div class="bg-white px-3 border-round py-4 d-flex align-items-start flex-column" style="height: 100%">
    <a href="{{ route('web.product.detail', [$item_product->category->slug, $item_product->slug]) }}" class="mb-auto">
        {{ showThumbnail($item_product->thumbnail, 200, 200, 'w-75 mx-auto mb-auto') }}
    </a>
    @if ($item_product->price_sell != $item_product->price_origin)
        <div class="sale-off">
            -{{ round(100 - ($item_product->price_sell / $item_product->price_origin) * 100, 1) }}%
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('web.product.detail', [$item_product->category->slug, $item_product->slug]) }}">{{ $item_product->title }}
        </a>
        <br>
        <strong>
            <a href="{{ route('web.supplier.detail', [$item_product->supplier->slug]) }}">
                {{ $item_product->supplier->title }}
            </a>
        </strong>
        <br>
        <span>{{ $item_product->unit_of_sell }}</span>
    </div>
    <div>
        <strong>{{ number_format($item_product->price_sell, 0) }}đ/{{ $item_product->unit_of_measure }}</strong>
        @if ($item_product->price_sell != $item_product->price_origin)
            <del
                class="ml-2">{{ number_format($item_product->price_origin, 0) }}đ/{{ $item_product->unit_of_measure }}</del>
        @endif
    </div>
    <div class="d-flex justify-content-between flex-wrap w-100">
        <div class="product-total-money">
            {{ number_format($item_product->price_sell * $item_product->mass_default, 0) }}đ
        </div>
        <div class="box-add-cart btn-add-cart" data-product-id="{{ $item_product->id }}"><i
                class="fas fa-cart-plus"></i>
        </div>
    </div>
</div>
