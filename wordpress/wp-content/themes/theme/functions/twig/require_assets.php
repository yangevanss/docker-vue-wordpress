<?php
function require_assets(String $src)
{
    $url = path_join(get_template_directory_uri() . '/src/', $src);
    if (WP_DEBUG) {
        $url = path_join('//' . $_SERVER['SERVER_NAME'] . ':' . BS_WEBPACK_PORT, $src);
    }
    return $url;
}
