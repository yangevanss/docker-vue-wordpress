<?php
function admin_style()
{
    $url = path_join(get_template_directory_uri(), './src/css/');
    if (WP_DEBUG) {
        $url = path_join('http://localhost:' . BS_WEBPACK_PORT, './js/');
        wp_enqueue_script('admin', $url . 'admin' . '.bundle.js');
        wp_enqueue_script('runtime', $url . 'runtime' . '.bundle.js');
        wp_enqueue_script('vendors', $url . 'vendors' . '.bundle.js');
        return;
    }
    wp_enqueue_style('admin', $url . 'admin.css', null, null, 'all');
}
