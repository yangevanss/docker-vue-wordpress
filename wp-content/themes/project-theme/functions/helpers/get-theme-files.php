<?php
function get_theme_files($path, $is_uri = false) {
    return ($is_uri ? get_template_directory_uri() : get_template_directory()) . $path;
}