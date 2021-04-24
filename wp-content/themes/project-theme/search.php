<?php
require_once 'context-data/context-data.php';

$context['title'] = 'Search results for ' . get_search_query();
Timber::render('search.twig', $context);