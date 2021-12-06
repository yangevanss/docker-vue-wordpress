<?php
function enqueue_script(String $file_name = null, String $replace = null)
{
    if($file_name && !wp_script_is($file_name)) {
        $url = path_join(get_template_directory_uri(), 'src/js/');
        if (WP_DEBUG) {
            $url = path_join('//' . $_SERVER['SERVER_NAME'] . ':' . BS_WEBPACK_PORT, 'js/');
        }
        if($replace && wp_script_is($replace)){
            wp_deregister_script($replace);
        }
        wp_enqueue_script($file_name, $url . $file_name . '.bundle.js', null, null, true);
    }
}
