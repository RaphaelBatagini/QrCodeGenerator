<?php

add_action( 'wp_ajax_check_email', 'check_email' );
add_action( 'wp_ajax_nopriv_check_email', 'check_email' );

function check_email()
{
    if (!$email = $_POST['email']) {
        echo json_encode([]);die;
    }

    $args = array(
        'post_type' => 'discount_partner_usr',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'email',
                'value' => $email,
            ),
            array(
                'relation' => 'OR',
                array(
                    'key' => 'validated',
                    'value' => false,
                ),
                array(
                    'key' => 'validated',
                    'compare' => 'NOT EXISTS',
                    'value' => '',
                ),
            ),
            // TODO: adicionar validacao de data
        ),
    );
    
    if (!$posts = get_posts($args)) {
        echo json_encode([]);die;
    }

    echo json_encode($posts);die;
}