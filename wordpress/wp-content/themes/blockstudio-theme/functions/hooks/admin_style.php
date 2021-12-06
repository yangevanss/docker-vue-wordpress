<?php
function admin_style()
{
    enqueue_style('admin');
    if (WP_DEBUG) {
        $url = path_join('//' . $_SERVER['SERVER_NAME'] . ':' . BS_WEBPACK_PORT, './js/');
        wp_enqueue_script('runtime', $url . 'runtime' . '.bundle.js');
        wp_enqueue_script('vendors', $url . 'vendors' . '.bundle.js');
        return;
    }
}
