<?php

add_filter( 'single_template', function( $page_template ) {
    if (get_post_type() === 'discount_partner' ) {
        $page_template = __DIR__ . '/../templates/single-discount-partner.php';
    }
    return $page_template;
});
