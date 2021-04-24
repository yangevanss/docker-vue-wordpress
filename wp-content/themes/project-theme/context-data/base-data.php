<?php
$global_cache_time = 1; // 全域快取時間
$global_key = 'global'; // 全域共通資料快取key基礎字串，多國語言的時候會有比如'global_zh' 'global_en'的區別
global $global_lang; // 全域語言變數

$context = Timber::get_context(); // timber context變數起始執行
$context['title'] = get_the_title(); // 全區域標題變數，若是archive需要另外呼叫，不可使用get_the_title()
$context['wp_body_class'] = join(' ', get_body_class()); // wordpress 原生產的body class，可考慮移除

if (function_exists('wpm_get_languages')) {
    // 如果有多國語言
    include_once get_theme_files('/functions/plugins/WP-Multilang/get_languages.php');
    $context['lang_switcher'] = $global_lang = get_languages(); // 語系陣列
    $global_key = $global_key . '_' . wpm_get_language();
}

// 本機開發時加入 hash 到 js 跟 css 後面，方便 BrowserSync 時不需要清 Cache
$context['is_develop_mode'] = preg_match('/localhost:/', $_SERVER['HTTP_HOST']);
$context['hash_parameter'] = '?hash=' . hash('ripemd160', date('h_i_s'));