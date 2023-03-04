<?php

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$checkFileExist = file_exists(get_template_directory() . '/archive-' . get_post_type() . '.php');

if(get_post_type() && $checkFileExist){
    require_once 'archive-' . get_post_type() . '.php';
    return;
}

require_once '404.php';
