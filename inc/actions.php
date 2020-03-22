<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('admin_post_discount_partner_register_user', function(){
    var_dump($_POST);
});