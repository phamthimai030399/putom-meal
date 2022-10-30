<footer class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="logo">
                    <a href="/" class="mr-3 align-content-center d-flex">
                        <img src="{{ asset('image/logo-black.png') }}" alt="logo">
                    </a>
                </div>
                <p>
                    Chúng tôi chuyên cung cấp các thực phẩm tươi sống, đảm bảo chất dinh dưỡng tối đa. Nguồn cung cấp
                    thực phẩm của chúng tôi đến từ
                    các nhà cung cấp hàng đầu Việt Nam. Chúng tôi mang sứ mệnh mang tới bữa ăn ngon cho từng gia đình
                    Việt.
                </p>
            </div>
            <div class="col-12 col-md-6">
                <h3>Các danh mục</h3>
                <div class="row">
                    @foreach ($categories as $item)
                        <a href="{{ route('web.category.detail', [$item->slug]) }}"
                            class="col-4">{{ $item->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container d-flex justify-content-between py-3">
            Copyright 2021 @ Putom Meal, All rights reserved.
        </div>
    </div>
</footer>
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "106826415195955");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v12.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
