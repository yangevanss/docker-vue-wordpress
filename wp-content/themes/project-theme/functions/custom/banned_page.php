<?php
// 目的：設定user禁止進入的頁面清單，導向到所有頁面
function redirect_user_in_banned_page() {
    $currentScreen = get_current_screen();
    $banned_page = array(
        'dashboard', // Dashboard 主選單
        'edit-post', // Posts 原生 post
        'edit-comments', // Comments 評論
        'tools', // Tools 工具列
        'options-general.php', // Settings 
        'jetpack', // Jetpack
        'themes', // Appearance
        // 'edit-page', // Pages
        // 'upload', // Media
        // 'plugins', // Plugins
        // 'users.php', // Users
    );
    if (in_array($currentScreen->id, $banned_page)) {
        print('<script>window.location.href="edit.php?post_type=page"</script>');
    }
}
add_action( 'admin_enqueue_scripts', 'redirect_user_in_banned_page' );