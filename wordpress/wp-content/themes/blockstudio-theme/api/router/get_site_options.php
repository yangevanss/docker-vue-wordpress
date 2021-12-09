<?php
function get_site_options($request){
    $response = [
        'code' => 404
    ];

    $fields = get_field('site_options', 'option');
    if($fields) {
        $response['code'] = 200;
        $response['data'] = $fields;
    }

    return new WP_REST_Response($response, 123);
}