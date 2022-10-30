<?php
function toSlug($doc)
{
    $str = addslashes(html_entity_decode($doc));
    $str = trim($str);
    $str = toNormal($str);
    $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $str = preg_replace("/( )/", '-', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace("\/", '', $str);
    $str = str_replace("+", "", $str);
    $str = strtolower($str);
    $str = stripslashes($str);
    return trim($str, '-');
}

function toNormal($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    return $str;
}

function showThumbnail($img, $width, $height, $class) {
    return view('web.layout.img', ['img' => $img, 'width' => $width, 'height' => $height, 'class' => $class]);
}

const ORDER_STATUS = [
    'pending' => 'Chờ duyệt',
    'confirmed' => 'Đã xác nhận',
    'completed' => 'Hoàn thành',
    'canceled' => 'Hủy'
];

const UNIT = [
    'Khay',
    'Khay 0.5 kg',
    'Khay 1 kg',
    'Con',
    'Lọ',
    'Chai',
    'Túi',
    'Gói',
    'Bó',
    'Combo',
    'Kg'
];

function startOrderStatus() {
    return array_keys(ORDER_STATUS)[0];
}


function showOrderStatus($status) {
    return ORDER_STATUS[$status];
}

function colorOrderStatus($status) {
    return array_search($status, array_keys(ORDER_STATUS)) + 1;
}

function noActionOrderStatus($status) {
    return array_search($status, array_keys(ORDER_STATUS)) > 1;
}

function nextOrderStatus($status) {
    $array_key = array_keys(ORDER_STATUS);
    $current_index = array_search($status, $array_key);
    $result = $current_index > 1 ? $array_key[$current_index ] : $array_key[$current_index + 1];
    return $result;
}

function disabledInputOrder($status) {
    return $status == 'pending' && !noActionOrderStatus($status) ? '' : 'disabled';
}

function getOrderStatusCanceled() {
    $array_key = array_keys(ORDER_STATUS);
    return end($array_key);
}
?>