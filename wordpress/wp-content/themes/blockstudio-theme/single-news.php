<?php

$context = Timber::context();
$context['title'] = get_the_title();

Timber::render(array('pages/single-' . $context['post']->post_type . '.twig'), $context);
