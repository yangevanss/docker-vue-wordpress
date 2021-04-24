<?php
// 目的：移除後台側邊按鈕
function remove_admin_side_btn () { 
   remove_menu_page('edit.php');
   remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'remove_admin_side_btn');