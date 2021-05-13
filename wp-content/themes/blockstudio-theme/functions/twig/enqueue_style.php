<?php
function enqueue_style(String $name, Bool $cover = true)
{
    if (!WP_DEBUG) {
        $url = path_join(get_template_directory_uri(), './src/css/');
        if ($cover && wp_style_is('default')) {
            wp_dequeue_style('default');
        }
        wp_enqueue_style($name, $url . $name . '.css', null, null, 'all');
    }
}
