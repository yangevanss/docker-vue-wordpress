<?php
function get_singular_context()
{
    $context = [];

    if(is_singular()){
        global $post;
        $fields = get_fields($post);
        $context['post'] = $post;
        $context['fields'] = $fields;
        $context['seo'] = get_seo($fields['seo'] ?? []);
        $context['title'] = get_the_title();
        $context['breadcrumb'] = get_breadcrumb('main_menu', function ($item) use ($post) {
            return $item['page_id'] == $post->ID;
        });
    }

    return $context;
}