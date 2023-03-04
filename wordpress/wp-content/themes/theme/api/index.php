<?php
require_once 'router/mail.php';
require_once 'router/get_site_options.php';

/**
 * origin api
 * wp-json/wp/v2/[router]
 */

add_action('rest_api_init', function () {
    register_rest_route('api', '/mail', [
        'methods' => 'POST',
        'callback' => 'api_send_mail',
        'args' => [
            'formValue' => [
                'required' => true,
            ]
        ]
    ]);
    register_rest_route('api', '/site_options', array(
        'methods' => 'GET',
        'callback' => 'get_site_options'
    ));
});
