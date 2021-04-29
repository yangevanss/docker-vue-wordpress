<?php
// 目的：設定後台樣式
add_action('wp_print_styles', function () { // 移除後台登入css
    if (is_page_template('template-landing.php')) {
        global $wp_styles;
        $wp_styles->queue = array();
    }
}, 100);

add_action('admin_head', function () { // 後台css引入
    $today = date("Y-m-d");
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_url') . '/src/style/admin.css>';
});

add_action('admin_footer', function () { // 後台使用者class輸入
    global $current_user;
    $classes = '';
    if (is_array($current_user->roles)) {
        foreach ($current_user->roles as $role) {
            $classes .= "user-role-{$role} ";
        }
    }
    echo '<script>(function(){' .
    'document.querySelector("body").classList.add("' . rtrim($classes) . '")' .
        '})();</script>';
    echo '<script>(function(){' .
    'document.querySelector("body").classList.add("' . 'post-id-' . get_the_ID() . '")' .
        '})();</script>';
});

// add_action('admin_init', function () { // 後台icon
//     wp_enqueue_style('fontello', get_bloginfo('template_url') . '/css/fontello.css', '', '4.0.3', 'all');
// });

add_editor_style(array('src/style/adminEditor.css')); // 後台可見即所得樣式
