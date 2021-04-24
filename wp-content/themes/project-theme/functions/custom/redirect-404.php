<?php
// 目的：導向 404
require_once get_theme_files('/context-data/context-data.php');
global $wp_query;
$wp_query->set_404();
status_header(404);
$context['head']['doc_title'] = '404 | ' . get_bloginfo();
Timber::render('404.twig', $context);