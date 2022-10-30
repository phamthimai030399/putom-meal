<!DOCTYPE html>
<html lang="en">

<head>
    @include('web.layout.meta_head')
</head>

<body>
    @include('web.layout.header')
    @yield('content')
    @include('web.layout.footer')
    @include('cms.layout.toast')

</body>

</html>
