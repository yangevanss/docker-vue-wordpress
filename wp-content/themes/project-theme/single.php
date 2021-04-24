<?php
require_once 'context-data/context-data.php';
$post_type = get_post_type($post); // 取得當前 single post-type

switch ($post_type) {
    // *** 允許進入內頁的 post-type ***
    case 'news':
        $context['suggest_posts'] = get_posts([
            'post_type' => $post_type,
            'orderby' => 'rand',
            'post__not_in' => array($post->id),
            'showposts' => 3,
        ]);
        Timber::render('single-' . $post_type . '.twig', $context);
        break;
    // *** 允許進入內頁的 post-type ***

    // *** 其餘強制生成偽裝 404 ***
    default:
        include 'functions/helpers/redirect-404.php';
    // *** 其餘強制生成偽裝 404 ***    
}
