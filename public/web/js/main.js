$(document).ready(function () {
    $("#btn-login").on('click', function () {
        $.ajax({
            url: URL_LOGIN,
            type: 'POST',
            data: {
                username: $("#username").val(),
                password: $("#password").val(),
            },
            success: function (result) {
                if (result.success) {
                    $('#loginModal').modal("hide");
                    toastr.success(result.message);
                    $('#header-login-success').removeClass('d-none');
                    $('#header-before-login').addClass('d-none');
                    $('.count-product-in-cart').html(result.count_product_in_cart);
                    if (result.count_product_in_cart > 0) {
                        $('.count-product-in-cart').removeClass('d-none')
                    } else {
                        $('.count-product-in-cart').addClass('d-none')
                    }
                } else {
                    $('#login-fail-noti').html(result.message);
                }
            }
        });
    });
    $(".btn-add-cart").on('click', function () {
        $.ajax({
            url: URL_ADD_CART,
            type: 'POST',
            data: {
                product_id: $(this).data('product-id'),
            },
            success: function (result) {
                if (result.success) {
                    $('#cart-quantity-product-' + result.product.id).html(result.product.quantity);
                    $('#cart-price-product-' + result.product.id).html(result.product.price);
                    $('#cart-total-money-product-' + result.product.id).html(result.product.total_money);
                    $('.count-product-in-cart').html(result.count_product);
                    if (result.count_product > 0) {
                        $('.count-product-in-cart').removeClass('d-none')
                    } else {
                        $('.count-product-in-cart').addClass('d-none')
                    }
                    toastr.success(result.message);
                } else {
                    if (result.message == 'login_please') {
                        toastr.error('Bạn cần đăng nhập để thêm giỏ hàng.');
                        $('#loginModal').modal("show");
                    } else {
                        toastr.error(result.message);
                    }
                }
            }
        });
    });

    $(".btn-minus-cart").on('click', function () {
        $.ajax({
            url: URL_MINUS_CART,
            type: 'POST',
            data: {
                product_id: $(this).data('product-id'),
            },
            success: function (result) {
                if (result.success) {
                    $('#cart-quantity-product-' + result.product.id).html(result.product.quantity);
                    $('#cart-price-product-' + result.product.id).html(result.product.price);
                    $('#cart-total-money-product-' + result.product.id).html(result.product.total_money);
                    $('.count-product-in-cart').html(result.count_product);
                    if (result.count_product > 0) {
                        $('.count-product-in-cart').removeClass('d-none')
                    } else {
                        $('.count-product-in-cart').addClass('d-none')
                    }
                    toastr.success(result.message);
                } else {
                    toastr.success(result.message);
                }
            }
        });
    });

});

