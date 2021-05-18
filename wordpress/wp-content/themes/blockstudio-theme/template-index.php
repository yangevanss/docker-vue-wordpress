<?php

/**
 * Template Name: 首頁樣板
 */

$context = Timber::context();
$context['title'] = get_the_title();

Timber::render(array('pages/page-index.twig'), $context);

