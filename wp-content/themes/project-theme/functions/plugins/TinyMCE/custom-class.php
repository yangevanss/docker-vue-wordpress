<?php
// 目的：客製化 TinyMCE class
function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/* Callback function to filter the MCE settings */
function my_mce_before_init_insert_formats( $init_array ) {  
 
    // Define the style_formats array
    // 別人的範例：https://gist.github.com/martylouis/11234749
    $style_formats = array(  
        /*
        * Each array child is a format with it's own settings
        * Notice that each array has title, block, classes, and wrapper arguments

        * Title: is the label which will be visible in Formats menu
        * Block: defines whether it is a span, div, selector, or inline style
        * Classes: allows you to define CSS classes
        * Wrapper: whether or not to add a new block-level element around any selected elements
        */
        array(  
            'title' => 'Content Block',  
            'block' => 'div',  
            'classes' => 'content-block',
            'wrapper' => true,
                
        ),  
        array(  
            'title' => 'Blue Button',  
            'block' => 'span',  
            'classes' => 'blue-button',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Red Button',  
            'classes' => 'red-button',
            'wrapper' => false,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); // Attach callback to 'tiny_mce_before_init'