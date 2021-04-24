<?php
function posttype_admin_css() {
    global $post_type;
    /* set post types */
    $post_types = array(
        'post',
        'page',
        'news'
    );
    if(in_array($post_type, $post_types))
    echo '<style type="text/css">#preview-action {display: none;}</style>';
}
add_action( 'admin_head-post-new.php', 'posttype_admin_css' );
add_action( 'admin_head-post.php', 'posttype_admin_css' );