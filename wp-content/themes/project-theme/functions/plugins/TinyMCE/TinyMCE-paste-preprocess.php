<?php
add_filter('tiny_mce_before_init', 'configure_tinymce');

function configure_tinymce($in)
{
    $white_list = "'p,span,b,strong,i,em,h3,h4,h5,h6,ul,li,ol'"; // 可修改容許的白名單
    $in['paste_preprocess'] = "function(plugin, args){
    // Strip all HTML tags except those we have whitelisted
    var whitelist = " . $white_list . ";
    var stripped = jQuery('<div>' + args.content + '</div>');
    var els = stripped.find('*').not(whitelist);
    for (var i = els.length - 1; i >= 0; i--) {
      var e = els[i];
      jQuery(e).replaceWith(e.innerHTML);
    }
    // Strip all class and id attributes
    stripped.find('*').removeAttr('id').removeAttr('class');
    // Return the clean HTML
    args.content = stripped.html();
  }";
    return $in;
}
