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

add_action('rest_api_init', function () {
    register_rest_route('discount-partner/v1/api', '/login/', array(
        'methods' => WP_REST_Server::CREATABLE,
        'callback' => 'get_customer_data',
    ));
});