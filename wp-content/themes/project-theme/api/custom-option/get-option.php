<?php
function get_wp_options() {

    $response['code'] = 200;
    $response['data'] = get_custom_options();

    return new WP_REST_Response($response, 123);
}