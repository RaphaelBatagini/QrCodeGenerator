<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action(
    'admin_post_discount_partner_register_user', 
    'discount_partner_register_user'
);

add_action(
    'admin_post_nopriv_discount_partner_register_user', 
    'discount_partner_register_user'
);

function discount_partner_register_user(){
    $post_id = wp_insert_post(
        array(
            'post_title' => $_POST['email'],
            'post_type' => 'discount_partner_usr',
            'post_status' => 'publish',
        )
    );

    if (!$post_id) {
        wp_safe_redirect(get_permalink($_POST['discount_partner']) . '?error=1');
        exit;
    }

    add_post_meta($post_id, 'discount_partner', $_POST['discount_partner']);
    add_post_meta($post_id, 'email', $_POST['email']);
    add_post_meta($post_id, 'name', $_POST['name']);
    add_post_meta($post_id, 'gender', $_POST['gender']);
    add_post_meta($post_id, 'birthdate', $_POST['birthdate']);
    add_post_meta($post_id, 'phone', $_POST['phone']);

    wp_safe_redirect(get_permalink($_POST['discount_partner']) . '?success=1');
    exit;
}
