<?php 
// 目的：開啟左側舊版選單
add_action('widgets_init', function () {
    register_sidebar(
        array(
            'name' => __('Footer', 'twentynineteen'),
            'id' => 'sidebar-1',
            'description' => __('Add widgets here to appear in your footer.', 'twentynineteen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
});