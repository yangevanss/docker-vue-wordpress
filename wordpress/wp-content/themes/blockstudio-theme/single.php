<?php

/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

Timber::render(array('pages/single-' . $context['post']->ID . '.twig', 'pages/single-' . $context['post']->post_type . '.twig', 'pages/single-' . $context['post']->slug . '.twig', 'pages/single.twig'), $context);
