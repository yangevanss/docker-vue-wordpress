<?php
function enqueue_style(String $file_name = null, Bool $hot = false, String $key = 'default')
{
    if($hot){
        $key = $file_name;
        enqueue_script($file_name, $key);
    }

    if (!WP_DEBUG) {
        if(!$file_name) {
            $file_name = $key;
        }

        $url = path_join(get_template_directory_uri(), './src/css/');

        wp_enqueue_style($key, $url . $file_name . '.css', null, null, 'all');
    }
}
