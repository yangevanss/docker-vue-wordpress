<?php
// 設定頁面陣列
function get_page_list() {
    // 頁面列表
    return [
        [
            // 首頁
            'id' => 2,
            'post_type' => false,
            'check_title' => 'index',
        ], [
            // 關於我們
            'id' => 3,
            'post_type' => false,
            'check_title' => 'about',
        ], [
            // 列表
            'id' => 5,
            'post_type' => true,
            'check_title' => 'news',
        ],
    ];
}

function get_default_pages() {
    // 頁面資料取得
    wp_reset_postdata();
    $default_pages = get_page_list();

    $nav_list = [];
    foreach ($default_pages as $key => $menu_item) {
        $page_id = $menu_item['id'];
        $nav_list[$menu_item['check_title']] = [
            'title' => get_the_title($page_id),
            'link' => get_the_permalink($page_id),
            'id' => $page_id,
            'check_title' => $menu_item['check_title'],
        ];
        if (function_exists('wpm_get_languages')) {
            $post_en = wpm_translate_post(get_post($page_id), 'en');
            $nav_list[$menu_item['check_title']]['enTitle'] = isset($post_en->en_title)
                ? $post_en->en_title
                : $post_en->post_title;
        }
    }
    return $nav_list;
}