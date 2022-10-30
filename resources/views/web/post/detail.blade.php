@extends('web.layout.index')
@section('content')
    <main class="mb-3">
        <div class="container container-sm">
            <h2 class="py-3">{{ $oneItem->title }}</h2>
            <div class="p-3">{!! $oneItem->content !!}</div>
        </div>

    </main>
@endsection
