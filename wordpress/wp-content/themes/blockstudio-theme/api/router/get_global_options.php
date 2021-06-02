<?php
function get_global_options($request){
    $response = [
        'code' => 404
    ];

    $fields = get_field('global_options', 'option');
    if($fields) {
        $response['code'] = 200;
        $response['data'] = $fields;
    }

    return new WP_REST_Response($response, 123);
}