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
    var_dump($_POST);die;
}
