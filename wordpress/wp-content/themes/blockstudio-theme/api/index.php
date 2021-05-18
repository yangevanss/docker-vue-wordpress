<?php
require_once 'router/mail.php';

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
});
