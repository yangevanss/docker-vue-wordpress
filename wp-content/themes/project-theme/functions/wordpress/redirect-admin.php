<?php
// 目的：轉址後台初始頁面
add_action('load-index.php', function () {
    $redirect_url = admin_url('profile.php');
    wp_redirect($redirect_url);
});