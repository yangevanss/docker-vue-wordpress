<?php
function enqueue_script(String $file_name = null, String $key = null)
{
    $key = $key ? $key : $file_name;
    if($file_name && !wp_script_is($key)) {
        $url = path_join(get_template_directory_uri(), 'src/js/');
        if (WP_DEBUG) {
            $url = path_join('//' . $_SERVER['SERVER_NAME'] . ':' . BS_WEBPACK_PORT, 'js/');
        }
        wp_enqueue_script($key, $url . $file_name . '.bundle.js', null, null, true);
    }
}
