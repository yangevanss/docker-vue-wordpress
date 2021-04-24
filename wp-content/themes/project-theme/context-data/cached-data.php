<?php
// 全域靜態 資料快取
// 所有在 set_cached_data functions內的key值都可以在程式執行完畢後用$context['key值']取用
require_once get_theme_files('/functions/helpers/menu-to-array.php');

function set_cached_data($lang = null) {
    // menu_to_array() 所在： menu-to-array.php
    // get_default_pages() 所在： page-set.php
    // get_custom_options() 所在： option-set.php
    $page_list = get_default_pages();
    return [
        'site_name' => get_option('blogname'), // 站名
        'page_list' => $page_list, // 頁面列表
        'nav' => menu_to_array('nav'), // 桌機菜單
        'footer' => menu_to_array('footer'), // footer菜單
        'menu' => menu_to_array('menu'), // 漢堡菜單
        'option' => get_custom_options($lang), // option資料
        'default_og' => get_field('og', $page_list['index']['id']), // 預設使用首頁分享
    ];
}

$cached_data = TimberHelper::transient($global_key, function () { // 呼叫 共用資料 的暫存
    return set_cached_data($GLOBALS['global_lang']);
}, $global_cache_time);

foreach ($cached_data as $key => $value) {
    $context[$key] = $value;
}
