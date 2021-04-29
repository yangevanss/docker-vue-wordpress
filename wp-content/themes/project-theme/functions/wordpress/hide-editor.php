<?php
/**
 * 用途：隱藏所有 page 的編輯器，可設定除外條件
 *
 */
add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
    // Get the Post ID.
    // $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    // if( !isset( $post_id ) ) return;

    /* 隱藏所有 editor 除指定 id */
    // $except_id = []; // 放入指定頁面 id
    // if (!in_array($post_id, $except_id)) {
    //     remove_post_type_support('page', 'editor');
    // }

    /* 隱藏 editor 在指定 slug */
    // $homepgname = get_the_title($post_id);
    // if($homepgname == 'Homepage'){ 
    //     remove_post_type_support('page', 'editor');
    // }

    /* 隱藏 editor 在指定 template */
    // $template_file = get_post_meta($post_id, '_wp_page_template', true); // 取得 template 名稱

    // if($template_file == 'my-page-template.php'){ // the filename of the page template
    //     remove_post_type_support('page', 'editor');
    // }
}