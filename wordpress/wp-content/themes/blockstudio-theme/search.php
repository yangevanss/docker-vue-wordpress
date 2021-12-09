<?php

/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$templates = array('pages/page-search.twig');

$context = Timber::context();
global $posts;
$context['posts'] = $posts;
$context['seo'] = get_seo();
$context['title'] = 'Search results for ' . get_search_query();

Timber::render($templates, $context);
