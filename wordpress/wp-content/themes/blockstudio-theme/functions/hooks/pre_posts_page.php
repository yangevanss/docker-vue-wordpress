<?php
function pre_posts_page($query)
{
    // $query->set('post_type', ['post', 'test_post_type']);
    if (is_post_type_archive('test_post_type')) {
        $query->set('posts_per_page', 8);
        return;
    }
    if (is_archive() && $query->is_main_query()) {
        $query->set('posts_per_page', 8);
        return;
    }
    if ($query->is_search() && $query->is_main_query()) {
        $query->set('posts_per_page', 8);
        return;
    }
    $query->set('posts_per_page', -1);
}
