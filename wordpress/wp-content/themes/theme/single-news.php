<?php

$context = Timber::context();

Timber::render(array('pages/single-' . $context['post']->post_type . '.twig'), $context);
