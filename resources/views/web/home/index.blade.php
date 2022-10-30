@extends('web.layout.index')
@section('content')
    <main>
        <section class="container banner mt-3">
            <div class="row">
                <div class="col-12 col-md-7 pr--md-0 mb-3">
                    <div id="demo" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner border-round">
                            <div class="carousel-item active">
                                <img src="{{ asset('image/banner/slider-1.jpg') }}" alt="banner" width="950" height="400">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('image/banner/slider-2.jpg') }}" alt="banner" width="950" height="400">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('image/banner/slider-3.jpg') }}" alt="banner" width="950" height="400">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-5">
                    {{ showThumbnail('image/banner/banner-1.jpg', 750, 200, 'border-round') }}
                    {{ showThumbnail('image/banner/banner-2.jpg', 750, 200, 'mt-3 border-round') }}
                </div>
            </div>
        </section>
        <section class="container best-service mt-3">
            <div class="row">
                <div class="col-12 col-md-3 item mb-3">
                    <div class="px-3 py-4 border-round">
                        <i class="fas fa-shipping-fast"></i>
                        Miễn phí ship
                    </div>
                </div>
                <div class="col-12 col-md-3 item mb-3">
                    <div class="px-3 py-4 border-round">
                        <i class="fas fa-phone-volume"></i>
                        Hỗ trợ 24/7
                    </div>
                </div>
                <div class="col-12 col-md-3 item mb-3">
                    <div class="px-3 py-4 border-round">
                        <i class="fas fa-wallet"></i>
                        Thanh toán dễ dàng
                    </div>
                </div>
                <div class="col-12 col-md-3 item mb-3">
                    <div class="px-3 py-4 border-round">
                        <i class="fas fa-gift"></i>
                        Nhiều quà tặng
                    </div>
                </div>
            </div>
        </section>
        <section class="content bg-gray mt-3 py-3">
            <div class="container">
                @foreach ($categories_home as $item)
                    <div class="item-box row">
                        <div class="col-12 text-center py-3">
                            <h3>
                                <a href="{{ route('web.category.detail', [$item->slug]) }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p>{!! $item->description !!}</p>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                @foreach ($item->products as $item_product)
                                    <div class="col-6 col-md-3 item-product">
                                        {{ view('web.product._item', ['item_product' => $item_product]) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
