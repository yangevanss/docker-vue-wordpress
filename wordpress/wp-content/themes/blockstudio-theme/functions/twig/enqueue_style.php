<?php
function enqueue_style(String $file_name = null, String $key = null)
{
    $key = $key ? $key : $file_name;
    if (WP_DEBUG){
        enqueue_script($file_name, $key);
        return;
    }
    if($file_name && !wp_style_is($key)) {
        $url = path_join(get_template_directory_uri(), 'src/css/');
        wp_enqueue_style($key, $url . $file_name . '.css', null, null, 'all');
    }
}
