<?php
function enqueue_page_script_style(String $file_name = null)
{
    // TODO if page only style
    enqueue_style($file_name, 'default');
    enqueue_script($file_name, 'default');
}