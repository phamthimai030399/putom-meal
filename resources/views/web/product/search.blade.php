@extends('web.layout.index')
@section('content')
    <main class="mb-3 bg-gray ">
        <div class="container container-sm">
            <h2 class="p-3">Kết quả tìm kiếm: {{ $condition['p'] }}</h2>
                <div class="row d-flex justify-content-between">
                    <div class="flex-fill text-center">
                        <form action="{{ route('web.product.search') }}" method="GET"
                            class="col-12 col-md-8 p-0 mx-auto position-relative">
                            <input type="text" class="input-search w-100" name="p" value="{{ $condition['p'] }}">
                            <button class="button-search d-flex align-content-center"><i class="icofont-search"></i></button>
                        </form>
                    </div>
                </div>
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
