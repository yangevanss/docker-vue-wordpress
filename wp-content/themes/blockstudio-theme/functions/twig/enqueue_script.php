<?php
function enqueue_script(String $name, Bool $cover = true)
{
    $url = path_join(get_template_directory_uri(), './src/js/');
    if (WP_DEBUG) {
        $url = path_join('http://localhost:' . BS_WEBPACK_PORT, './js/');
    }
    if ($cover && wp_script_is('default')) {
        wp_dequeue_script('default');
    }
    wp_enqueue_script($name, $url . $name . '.bundle.js', null, null, true);
}
