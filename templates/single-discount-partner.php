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
            <div class="col-12 text-center">
                <img src="<?= plugin_dir_url(__FILE__) . '../assets/images/criarme.png' ?>" 
                    alt="<?php the_title() ?>" class="m-auto"/>
            </div>
            <div class="col-12 text-center">
                <img src="<?php the_post_thumbnail_url('thumbnail') ?>" 
                alt="<?php the_title() ?>" class="m-auto"/>
                <h1>Complete seu cadastro</h1>
            </div>
            <div class="col-md-4 offset-md-4">
                <form class="form form-steps">
                    <div class="step" data-step="1">
                        <div class="form-group">    
                            <input type="email" class="form-control mb-3" 
                                id="email" name="email">
                            <label for="email">E-mail</label>
                            <a class="btn btn-primary w-100 next">Continuar</a>
                        </div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="form-group">    
                            <input type="text" class="form-control mb-3" 
                                id="name" name="name">
                            <label for="email">Nome</label>

                            <input type="text" class="form-control mb-3" 
                                id="name" name="name">
                            <label for="email">Sexo</label>

                            <input type="text" class="form-control mb-3" 
                                id="birthdate" name="birthdate">
                            <label for="phone">Data de nascimento</label>

                            <input type="text" class="form-control mb-3" 
                                id="phone" name="phone">
                            <label for="phone">Telefone</label>
                            
                            <a class="btn btn-primary w-100">Continuar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php wp_footer() ?>
</body>
</html>