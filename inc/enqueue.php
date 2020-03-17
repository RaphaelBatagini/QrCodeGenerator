<?php

function discount_partner_theme_scripts()
{
    if (get_post_type() !== 'discount_partner') {
        return;
    }

    wp_enqueue_style(
        'style',
        plugin_dir_url(__FILE__) . '../assets/styles/style.css'
    );

    wp_enqueue_script(
        'script',
        plugin_dir_url(__FILE__) . '../assets/scripts/script.js',
        array('jquery'),
        false,
        true
    );

    wp_enqueue_style(
        'bootstrap-style', 
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
    );

    wp_enqueue_script(
        'bootstrap-script', 
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        array('jquery'),
        false,
        true
    );

    wp_dequeue_style('sage/main.css');
}
add_action('wp_enqueue_scripts', 'discount_partner_theme_scripts', 150);
