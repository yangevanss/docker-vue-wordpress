<?php 
// 目的：篩選 h1, h2, h3....
function remove_h1_from_heading($args) {
    // Just omit h1 from the list
    $args['block_formats'] = 'Heading 3=h3;Paragraph=p;';
    return $args;
}
add_filter('tiny_mce_before_init', 'remove_h1_from_heading' );