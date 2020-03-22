<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_filter( 'single_template', function( $page_template ) {
    if (get_post_type() === 'discount_partner' ) {
        $page_template = __DIR__ . '/../templates/single-discount-partner.php';
    }
    return $page_template;
});

// load json with fields
function discount_partner_acf_json_load_point( $paths ) {
    // append path
    $paths[] = plugin_dir_path( __DIR__ ) . '/acf-json';
    // return
    return $paths;
  }
add_filter('acf/settings/load_json', 'discount_partner_acf_json_load_point');