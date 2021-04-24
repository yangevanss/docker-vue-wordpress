<?php
$page_list = get_default_pages();
$context['head'] = [ // 全區域og變數
    'site_name' => get_bloginfo(), // 站名
    'doc_title' => get_the_title() . ' | ' . get_bloginfo(), // 預設標題
    'doc_desc' => get_field('og', $page_list['index']['id'])['desc'], // 預設分享敘述
    'doc_thumb' => get_field('og', $page_list['index']['id'])['thumb'], // 預設分享圖片
    'og_type' => "website", // 預設型別
    'lang' => function_exists('wpm_get_language')
        ? wpm_get_language()
        : get_bloginfo('language'), // 語言
    'url' => get_permalink(), // 預設連結
];

if (is_page('index')) {
    // 首頁
    $context['head']['doc_title'] = get_bloginfo();

} elseif (is_404()) {
    // 404
    $context['head']['doc_title'] = '404 | ' . get_bloginfo();

} elseif (is_single()) {
    // 內頁 視實際狀況修改
    $og = get_field('og');
    if ($og['desc'] || $og['thumb']) {
        $context['head']['doc_desc'] = $og['desc'];
        $context['head']['doc_thumb'] = $og['thumb'];
    }

} elseif (is_page()) {
    // 單頁
    $og = get_field('og');
    if ($og['desc'] || $og['thumb']) {
        $context['head']['doc_desc'] = $og['desc'];
        $context['head']['doc_thumb'] = $og['thumb'];
    }

} elseif (is_archive() && !is_tag() && !is_search()) {
    // 一般列表頁
    $post_type = get_query_var('post_type');

    $og = get_field('og', $page_list[$post_type]['id']);
    if ($og['desc'] || $og['thumb']) {
        $context['head']['doc_desc'] = $og['desc'];
        $context['head']['doc_thumb'] = $og['thumb'];
    }

    // 總表 & 分類
    $tag = get_queried_object();
    $context['head']['doc_title'] = $tag->label
        ? $page_list[$post_type]['title'] . ' | ' . get_bloginfo()
        : $tag->name . ' | ' . get_bloginfo();
    $context['head']['url'] = $tag->label
        ? $page_list[$post_type]['link']
        : get_tag_link(get_queried_object_id());

} elseif (is_search()) {
    // search頁
    $context['head']['doc_title'] = 'Search :' . get_search_query() . ' | ' . get_bloginfo();

} elseif (is_tag()) {
    // tag頁
    $tag = get_queried_object();
    $current_tag = $tag->name;
    $context['head']['doc_title'] = 'Tag : ' . $current_tag . ' | ' . get_bloginfo();
    $context['head']['url'] = get_tag_link(get_queried_object_id());
    $context['tag_query'] = $current_tag; // 搜尋結果參數

}