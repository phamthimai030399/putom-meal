@extends('web.layout.index')
@section('content')
    <main class="mb-3 py-4 bg-gray">
        <div class="container container-sm">
            <h2 class="p-3">{{ $oneItem->title }}</h2>
            <p>{!! $oneItem->description !!}</p>
            <div class="row">
                @foreach ($products as $item_product)
                    <div class="col-6 col-md-3 item-product">
                        {{ view('web.product._item', ['item_product' => $item_product]) }}
                    </div>
                @endforeach
            </div>
        </div>

    </main>
@endsection
