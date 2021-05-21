<?php
function get_archive_context()
{
    $context = [];

    if(is_archive()){
        $posts = new Timber\PostQuery();
        $post_type = get_post_type();
        $context['posts'] = $posts;
        $fields = get_fields($post_type . '_options');
        $context['seo'] = get_seo($fields ? $fields['seo'] : null);
        $context['title'] = post_type_archive_title(null, false);
        $context['breadcrumb'] = get_breadcrumb('main_menu', function ($item) use ($post_type) {
            return $item['url'] == get_post_type_archive_link($post_type);
        });
    }

    return $context;
}