<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title() ?> Descontos</title>
    <?php wp_head() ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-3 pb-5">
                <img src="<?= plugin_dir_url(__FILE__) . '../assets/images/criarme.png' ?>" 
                    alt="<?php the_title() ?>" class="m-auto"/>
            </div>
            <?php
                if (!empty($_GET['success'])) {
                    include 'parts/success-message.php';
                } elseif (!empty($_GET['failure'])) {
                    include 'parts/error-message.php';
                } else {
                    include 'parts/registration-form.php';
                }
            ?>
        </div>
    </div>

    <?php wp_footer() ?>
</body>
</html>