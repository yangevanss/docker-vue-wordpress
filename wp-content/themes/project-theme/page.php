<?php
require_once 'context-data/context-data.php';
$current_id = get_the_ID(); // 取得當前頁面ID
// *** 與規定好的頁面列表比對，如果匹配，放入頁面列表訂好的 Key 值 ***
$check_key = null; 
foreach (get_default_pages() as $page_key => $page) {
    if ($page['id'] === $current_id):
        $check_key = $page_key;
        continue;
    endif;
}
// *** 與規定好的頁面列表比對，如果匹配，放入頁面列表訂好的 Key 值 ***


// *** 根據 Key 值做特別的事情 ***
switch ($check_key):
    case 'index':
        include 'query/page-index.php';
        break;
    case 'about':
        include 'query/page-about.php';
        break;
endswitch;
// *** 根據 Key 值做特別的事情 ***


// *** 如果 Key 值有在頁面列表內，生成同樣 Key 的twig，否則強制生成偽裝 404 ***
if ($check_key) {
    Timber::render('page-' . $check_key . '.twig', $context);
} else {
    include get_theme_files('/functions/helpers/redirect-404.php');
}
// *** 如果 Key 值有在頁面列表內，生成同樣 Key 的twig，否則強制走向 404 ***
