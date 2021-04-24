<?php
// 集中管理所有的 wordpress ajax
include 'mail.php';
require_once 'custom-option/get-option.php';

add_action('rest_api_init', function() {
    // // TODO: 白名單檢查
    // // host & ip 白名單檢查
    // $host_whitelist = ['blockstudio.tw'];
    // 
    // // ip 須設置為需要打 API 之主機 IP
    // $ip_whitelist = [''];
    // if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    //     $origin = $_SERVER['HTTP_ORIGIN'];
    // }
    // else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    //     $origin = $_SERVER['HTTP_REFERER'];
    // } else {
    //     $origin = $_SERVER['REMOTE_ADDR'];
    // }
    // $parsed_host = parse_url($origin, PHP_URL_HOST);
    // if (!in_array($parsed_host, $host_whitelist) && !in_array($origin, $ip_whitelist)) {
    //     die('REST API is disabled.');
    // }
    register_rest_route('api', '/get_options', array(
        'methods' => 'GET',
        'callback' => 'get_wp_options'
    ));

    register_rest_route('api/v1', '/mail', array(
        'methods' => 'POST',
        'callback' => 'api_send_mail',
        'args' => array(
            'formValue' => array(
                'required' => true,
            ),
        )
    ));
});