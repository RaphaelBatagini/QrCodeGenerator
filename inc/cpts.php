<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Register Custom Post Type for Discount Partner
function discount_partner_custom_post_type() {
	register_post_type(
		'discount_partner',
		get_args(
			'Parceiros de Desconto', 
			'Parceiro de Desconto'
		)
	);
}
add_action( 'init', 'discount_partner_custom_post_type', 0 );

// Register Custom Post Type for User applied for discount
function discount_partner_user_custom_post_type() {
	register_post_type(
		'discount_partner_usr',
		get_args(
			'Cadastros para desconto', 
			'Cadastros para desconto'
		)
	);
}
add_action( 'init', 'discount_partner_user_custom_post_type', 0 );

function get_args($plural_name, $singular_name) {
	$labels = array(
		'name'                  => _x( $plural_name, 'Post Type General Name', TEXT_DOMAIN ),
		'singular_name'         => _x( $singular_name, 'Post Type Singular Name', TEXT_DOMAIN ),
		'menu_name'             => __( $plural_name, TEXT_DOMAIN ),
		'name_admin_bar'        => __( $singular_name, TEXT_DOMAIN ),
	);
	return array(
		'label'                 => __( $singular_name, TEXT_DOMAIN ),
		'description'           => __( $singular_name, TEXT_DOMAIN ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
}
