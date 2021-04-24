<?php
// 目的：限制特定格式上傳大小
add_filter('wp_handle_upload_prefilter', 'f711_image_size_prevent');
function f711_image_size_prevent($file) {
    $size = $file['size'];
    $size = $size / 1024; // Calculate down to KB
    $type = $file['type'];
    
    // 圖片格式
    $is_image = strpos($type, 'image');
    $limit = 500; // Your Filesize in KB
    if ( ( $size > $limit ) && ($is_image !== false) ) {
        $file['error'] = '你上傳的圖片必須小於 '.$limit.'KB';
    }
    return $file;
}