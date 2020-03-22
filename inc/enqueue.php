<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function discount_partner_theme_scripts()
{
    if (get_post_type() !== 'discount_partner') {
        return;
    }

    wp_enqueue_style(
        'style-discount_partner',
        plugin_dir_url(__FILE__) . '../assets/styles/style.css',
        array(),
        false
    );

    wp_enqueue_style(
        'bootstrap-style', 
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        array(),
        false
    );

    wp_enqueue_script(
        'inputmask',
        plugin_dir_url(__FILE__) . '../assets/scripts/inputmask.js',
        array('jquery'),
        false,
        false
    );

    wp_enqueue_script(
        'bootstrap-script', 
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        array('jquery'),
        false,
        false
    );

    wp_enqueue_script(
        'jquery-validation-script', 
        'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js',
        array('jquery'),
        false,
        false
    );

    wp_enqueue_script(
        'script-discount_partner',
        plugin_dir_url(__FILE__) . '../assets/scripts/script.js',
        array('jquery', 'jquery-validation-script', 'inputmask'),
        false,
        true
    );

    wp_dequeue_style('sage/main.css');
}
add_action('wp_enqueue_scripts', 'discount_partner_theme_scripts', 150);
