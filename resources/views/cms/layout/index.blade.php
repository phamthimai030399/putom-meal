<?php $VER = 1.2 ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hệ thống quản trị Putom Meal</title>
    <link rel="icon" href="{{ asset('image/favicon.jpeg') }}" sizes="32x32">
    <link rel="stylesheet" href="{{ url('cms/css/coreui/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ url('cms/css/app.css?v=' . $VER) }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="{{ url('cms/js/tinymce.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body class="c-app">
    @include('cms.layout.sidebar')
    <div class="c-wrapper c-fixed-components">
        @include('cms.layout.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
            @include('cms.layout.footer')
        </div>
    </div>

    @include('cms.layout.toast')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('cms/js/coreui/coreui.bundle.min.js') }}"></script>

    <script src="{{ url('cms/js/common.js?v=' . $VER) }}"></script>
</body>

</html>
