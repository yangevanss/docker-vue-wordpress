<?php

$post_type = get_post_type();

if($post_type){
    $context = Timber::context();
    $context['category_terms'] = get_terms([
        'taxonomy' => [
            'category',
            $post_type . '_category',
        ],
        'hide_empty' => false,
    ]);
    $context['tag_terms'] = get_terms([
        'taxonomy' => [
            'post_tag',
            $post_type . '_tag',
        ],
        'hide_empty' => false,
    ]);
    
    if(is_tax()){
        /**
         * ?[post_type]_['tag'|'category']=slug 
         * /[post_type]_['tag'|'category']/slug 
         */
    }

    if(is_tag()){
        /** ?tag=slug */
    }

    if(is_category()){
        /** ?cat=cat_ID */
    }
    
    Timber::render(array('pages/archive-' . $post_type . '.twig'), $context);
    return;
}
require_once '404.php';
