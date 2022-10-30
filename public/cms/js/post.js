$(function() {
    $('select.category').select2({
        placeholder: "Lựa chọn danh mục",
        allowClear: true
    });
});
$(document).ready(function () {
    $('.add-new input[name="title"]').on('change', function () {
        $('.add-new input[name="slug"]').val(generate_slug_from_title($(this).val()));
    });
});
