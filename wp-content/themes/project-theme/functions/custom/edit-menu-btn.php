<?php
// 目的：增加左側「選單」按鈕
function add_edit_menu_btn() {
    add_menu_page( '選單', '選單', 'edit_posts', '/nav-menus.php', '', '', 80);
}
add_action('admin_menu', 'add_edit_menu_btn');
