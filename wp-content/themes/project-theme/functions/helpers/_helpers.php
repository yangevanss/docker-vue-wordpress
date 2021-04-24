<?php

function easyImg($id) { // 呼叫圖片
    $src = wp_get_attachment_image_src(get_post_thumbnail_id($id), false, '');
    return $src[0];
}

function contentExcerpt($limit) { // 節錄處理
    $content = explode(' ', get_the_excerpt(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/[.+]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function easyGetExcerpt($id) { // 呼叫節錄
    $easyexcerpt = esc_html(contentExcerpt(200, $id));
    $easyexcerpt = html_entity_decode($easyexcerpt);
    $easyexcerpt = wp_trim_words(wp_strip_all_tags($easyexcerpt), 200);
    return $easyexcerpt;
};

function fixImg($thumbImg) { // 修正有時候圖片型別異常的情形
    $src = wp_get_attachment_image_src($thumbImg, false, 'post-thumbnails');
    $thumbImg = $src[0];
    return $thumbImg;
}