<?php
// 文章分類
$result = [];
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $postDataFormat = null;
        switch (get_post_type()) {
            case 'news': // 最新消息
                $postDataFormat['type'] = get_post_type();
            break;
        }
        // $result[] = $postDataFormat;
        $result[] = $post;
    } // end while
} // end if

// 標籤
$tag = get_queried_object();
$currentTag = $tag->name;
$context['title'] = '# ' . $currentTag;
$context['list'] = $result;
$context['tag'] = $currentTag;