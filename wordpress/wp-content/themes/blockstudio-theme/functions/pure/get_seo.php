<?php

function get_seo($field, WP_Post $post = null)
{
    $generate = [
        'site_name' => get_bloginfo('name'),
        'title' => wp_get_document_title(),
        'title_template' => get_bloginfo('description'),
        'desc' => get_bloginfo('description'),
        'thumbnail' => null,
        'lang' => function_exists('wpm_get_language') ? wpm_get_language() : 'zh',
        'url' => get_permalink(),
        'og_type' => 'website'
    ];

    if($field){
        $generate['title'] = $field['title'];
        $generate['desc'] = $field['desc'] ?: $generate['desc'];
        $generate['thumbnail'] = $field['thumbnail'];
        if($post){
            $generate['title'] = $generate['title'] ?: $post->post_title;
        }
    }

    return $generate;
}
