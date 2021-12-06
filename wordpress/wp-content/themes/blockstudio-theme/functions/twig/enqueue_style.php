<?php
function enqueue_style(String $file_name = null, String $replace = null)
{
    if (WP_DEBUG){
        enqueue_script($file_name, $replace);
        return;
    }
    if($file_name && !wp_style_is($file_name)) {
        $url = path_join(get_template_directory_uri(), 'src/css/');
        if($replace && wp_style_is($replace)){
            wp_deregister_style($replace);
        }
        wp_enqueue_style($file_name, $url . $file_name . '.css', null, null, 'all');
    }
}
