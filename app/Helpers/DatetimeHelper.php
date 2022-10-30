<?php

use Illuminate\Support\Carbon;

function getDay($time, $type = 0)
{
    $getday = date('D', strtotime($time));
    $arrayDay = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $arrayDayVn = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];
    $arrayDayNumber = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'];
    $arrayDayLinkLite = ['thu-2', 'thu-3', 'thu-4', 'thu-5', 'thu-6', 'thu-7', 'chu-nhat'];
    $arrayDayLink = ['t2', 't3', 't4', 't5', 't6', 't7', 'cn'];
    if ($type == 0) {
        for ($i = 0; $i < count($arrayDay); $i++) {
            if ($getday == $arrayDay[$i]) {
                return $arrayDayVn[$i];
            };
        };
    };
    if ($type == 1) {
        for ($i = 0; $i < count($arrayDay); $i++) {
            if ($getday == $arrayDay[$i]) {
                return $arrayDayLink[$i];
            };
        };
    };
    if ($type == 2) {
        for ($i = 0; $i < count($arrayDay); $i++) {
            if ($getday == $arrayDay[$i]) {
                return $arrayDayLinkLite[$i];
            };
        };
    };
    if ($type == 3) {
        for ($i = 0; $i < count($arrayDay); $i++) {
            if ($getday == $arrayDay[$i]) {
                return $arrayDayNumber[$i];
            };
        };
    };
    if ($type == 4) {
        $current_type_6 = 'ngày ' . date('j', strtotime($time)) . ' tháng ' . date('n', strtotime($time)) . ' năm ' . date('Y', strtotime($time));
        return $current_type_6;
    }
}
if (!function_exists('convertDetailTime')) {
    function convertDetailTime($time)
    {
        $dow = getDay($time, 0);
        $date = date("d/m/Y", strtotime($time));
        $time = date("H:i", strtotime($time));
        return "{$dow}, ngày {$date} - {$time}";
    }
}

function diffForHumans($str_time)
{
    Carbon::setLocale('vi');
    $startTime = Carbon::parse($str_time);
    $endTime = Carbon::now()->setTimezone('+07:00');

    $totalDuration = $startTime->diffForHumans($endTime);
    return $totalDuration;
}
