<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

if($wp_query) {
    $wp_query->set_404();
}
status_header(404);

$context = Timber::context();
$context['title'] = wp_get_document_title();
$context['seo'] = get_seo(null);

Timber::render('pages/404.twig', $context);
