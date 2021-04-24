<?php
// 目的：移除後台admin bar
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('user-info');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('edit-profile');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('updates');
});