<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

include dirname(__FILE__) . '/../vendor/phpqrcode/qrlib.php';

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
        wp_safe_redirect(get_permalink($_POST['discount_partner']) . '?failure=1');
        exit;
    }

    add_post_meta($post_id, 'discount_partner', $_POST['discount_partner']);
    add_post_meta($post_id, 'email', $_POST['email']);
    add_post_meta($post_id, 'name', $_POST['name']);
    add_post_meta($post_id, 'gender', $_POST['gender']);
    add_post_meta($post_id, 'birthdate', $_POST['birthdate']);
    add_post_meta($post_id, 'phone', $_POST['phone']);
    add_post_meta($post_id, 'discount', get_field('discount_percentage', $_POST['discount_partner']));
    add_post_meta(
        $post_id, 
        'shelf_life', 
        date_create_from_format(
            'd/m/Y', 
            get_field('shelf_life', $_POST['discount_partner'])
        )->format('Y-m-d')
    );

    $qrCodeDir = wp_upload_dir()['basedir'] . '/discounts_partner_qrcode';
    if (!is_dir( $qrCodeDir )) {
        mkdir($qrCodeDir);
    }

    $qrCodeFileName = 'qrcode-' . $_POST['email'] . '-' . $_POST['discount_partner'] . '-' . $post_id . '-' . '.png';

    QRcode::png(
        $post_id, 
        $qrCodeDir . '/' . $qrCodeFileName
    );

    wp_mail(
        $_POST['email'],
        'Desconto no estabelecimento ' . get_the_title($_POST['discount_partner']),
        'Apresente o QRCode abaixo no estabelecimento e tenha acesso a seu desconto<br>' . 
        '<img src="'. wp_upload_dir()['baseurl'] . '/discounts_partner_qrcode\/' . $qrCodeFileName .'">',
        "Content-type: text/html; charset=UTF-8'"
    );

    wp_safe_redirect(get_permalink($_POST['discount_partner']) . '?success=1');
    exit;
}
