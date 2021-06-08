<?php

$post_type = get_post_type();

if ($post_type) {
    $context = Timber::context();

    $taxonomies = array_reduce(get_object_taxonomies($post_type), function ($acc, $taxonomy) {
        $acc[$taxonomy] = get_terms([
            'taxonomy' => [
                $taxonomy,
            ],
            'hide_empty' => false,
        ]);
        return $acc;
    }, []);

    if (is_tax()) {
        /**
         * ?[taxonomy_name]=slug 
         * /[taxonomy_name]/slug 
         */
    }

    if (is_tag()) {
        /** ?tag=slug */
    }

    if (is_category()) {
        /** ?cat=cat_ID */
    }

    Timber::render(array('pages/archive-' . $post_type . '.twig'), $context);
    return;
}
require_once '404.php';
