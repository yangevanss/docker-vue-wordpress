<?php
// 目的：移除原生 meta 欄位
function remove_thumbnail_box() {
    // remove_meta_box('postimagediv', ['pages', 'news'], 'normal');
    remove_meta_box( 'postimagediv', 'post', 'side' ); 
    remove_meta_box( 'postimagediv', 'page', 'side' );
}

add_action('do_meta_boxes', 'remove_thumbnail_box');
