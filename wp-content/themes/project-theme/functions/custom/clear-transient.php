<?php 
// 目的：清除快取
function delete_all_transients() {

    global $wpdb;

    $count = $wpdb->query(
        "DELETE FROM $wpdb->options
        WHERE option_name LIKE '\_transient\_%'"
    );

    return $count;
}

function clear_transients_actions(){

    if( empty( $_REQUEST['action'] ) ) {
        return;
    }

    if( empty( $_REQUEST['transient'] ) && ( 'clear_transients' !== $_REQUEST['action'] ) ) {
        return;
    }

    // if( ! current_user_can( 'manage_options' ) ) {
    //     return;
    // }

    if( ! wp_verify_nonce( $_REQUEST['_wpnonce'] , 'transient_id' ) ) {
        return;
    }

    if( 'clear_transients' !== $_REQUEST['action'] ) {

        $search    = ! empty( $_REQUEST['s'] ) ? urlencode( $_REQUEST['s'] ) : '';
        $transient = $_REQUEST['transient'];
        $site_wide = isset( $_REQUEST['name'] ) && false !== strpos( $_REQUEST['name'], '_site_transient' );

    }
    delete_all_transients();
    wp_safe_redirect( admin_url('profile.php') ); 
    exit;
}

function clear_transients_button( $wp_admin_bar ){
    // if ( ! current_user_can( 'manage_options' ) ) {
    //     return;
    // }
    $args = array(
        'id'     => 'clear-transient',
        'title'  => '清除快取',
        'parent' => 'top-secondary',
        'href'   => wp_nonce_url( add_query_arg( array( 'action' => 'clear_transients' ) ), 'transient_id' )
    );
    $wp_admin_bar->add_node( $args );
}
add_action( 'admin_init', 'clear_transients_actions');
add_action( 'admin_bar_menu', 'clear_transients_button',999 );