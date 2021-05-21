<?php
function get_singular_context()
{
    $context = [];

    if(is_singular()){
        $post = new Timber\Post();
        $fields = get_fields($post);
        $context['post'] = $post;
        $context['fields'] = $fields;
        $context['seo'] = get_seo($fields ? $fields['seo'] : null);
        $context['title'] = get_the_title();
        $context['breadcrumb'] = get_breadcrumb('main_menu', function ($item) use ($post) {
            return $item['page_id'] == $post->ID;
        });
    }

    return $context;
}