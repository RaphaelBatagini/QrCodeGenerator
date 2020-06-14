<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function get_customer_data(WP_REST_Request $request)
{
    $data = json_decode($request->get_body(), true);
    $response = new WP_REST_Response($data);

    if (empty($data['user']) || empty($data['pass'])) {
        $response->set_status(422);
        return $response;
    }

    $user = wp_authenticate($data['user'], $data['pass']);

    if ($user instanceof WP_Error) {
        $response->set_status(401);
        return $response;
    }

    return array(
        'user' => $user->data
    );
}

function validate_qrcode(WP_REST_Request $request)
{
    $data = json_decode($request->get_body(), true);

    // Check if endpoint was called with correct params
    if (empty($data['partner']) || empty($data['customer'])) {
        return formattedResponse(422, 'Parceiro e/ou cliente não informados');
    }

    $coupon = get_post($data['customer']);
    $coupon_meta = get_post_meta($coupon->ID);

    // Check if coupon have all required data
    if (
        empty($coupon_meta['discount_partner'])
        || empty($coupon_meta['discount'])
        || empty($coupon_meta['shelf_life'])
    ) {
        return formattedResponse(
            422,
            'Cadastro para desconto incompleto ou não encontrado'
        );
    }

    $validated = !empty($coupon_meta['validated']) ? 
        (int) $coupon_meta['validated'][0] : 0;
    
    // Check if coupon is already used
    if ($validated !== 0) {
        return formattedResponse(403, 'Cupom já foi utilizado');
    }

    // Check if coupon has a valid date
    if (!is_valid_coupon_date($coupon_meta['shelf_life'][0])) {
        return formattedResponse(403, 'Data para uso do cupom excedida');
    }

    // Check if user is associated with a partner
    $partner = get_partner($data['partner']);
    if (empty($partner) || !is_array($partner)) {
        return formattedResponse(
            401, 
            'Seu usuário não está associado a um parceiro de descontos'
        );
    }

    // Check if coupon is valid on user establishment
    if ($partner[0]->ID != $coupon_meta['discount_partner'][0]) {
        return formattedResponse(
            401, 
            'Cupom cadastrado para outro estabelecimento'
        );
    }
    
    // Mark coupon as already used
    if (!empty($data['validate'])) {
        update_post_meta($coupon->ID, 'validated', '1');
    }

    // Return coupon data
    return array(
        'name' => $coupon_meta['name'][0],
        'email' => $coupon_meta['email'][0],
        'discount' => $coupon_meta['discount'][0] . '%',
        'shelf_life' => $coupon_meta['shelf_life'][0],
        'establishment' => $partner[0]->post_title,
    );
}

function get_partner($partner_id)
{
    $args = array(
        'post_type' => 'discount_partner',
        'post_status' => 'publish',
        'meta_query' => array(
            array (
                'key' => 'user_validator',
                'value' => $partner_id,
                'compare' => '='
            )
        )
    );
    $query = new WP_Query($args);
    return $query->get_posts();
}

function is_valid_coupon_date($date)
{
    $date = date_create_from_format('Y-m-d', $date)->format('Ymd');
    return date('Ymd') <= $date;
}

function formattedResponse($statusCode, $message)
{
    $response = new WP_REST_Response();
    $response->set_status($statusCode);
    $response->set_data(array(
        'message' => $message
    ));
    return $response;
}

add_action('rest_api_init', function () {
    register_rest_route('discount-partner/v1/api', '/login/', array(
        'methods' => WP_REST_Server::CREATABLE,
        'callback' => 'get_customer_data',
    ));

    register_rest_route('discount-partner/v1/api', '/validate-qrcode/', array(
        'methods' => WP_REST_Server::CREATABLE,
        'callback' => 'validate_qrcode',
    ));
});