<?php
// 目的：自訂日期格式封裝
function customDateFormat($format, $date) {
    return date($format, strtotime($date));
}