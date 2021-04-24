<?php
// 目的：更改左下角文字
add_filter('admin_footer_text', function () {
    return '<a href="https://blockstudio.tw" target="_blank">版塊設計</a> | 02 2885 8586 | info@blockstudio.tw';
});