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
                <form class="form form-steps" method="post" 
                    action="<?= admin_url('admin-post.php') ?>">
                    <input type="hidden" name="action" 
                        value="discount_partner_register_user">
                    <input type="hidden" name="discount_partner" 
                        value="<?= get_the_ID() ?>">
                    <div class="step" data-step="1">
                        <div class="form-group">    
                            <input type="email" class="form-control mb-3" 
                                id="email" name="email" required>
                            <label for="email">E-mail</label>
                            <a class="btn btn-primary w-100 next">Continuar</a>
                        </div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="form-group">    
                            <input type="text" class="form-control mb-3" 
                                id="name" name="name" required>
                            <label for="email">Nome</label>

                            <select name="gender" class="form-control mb-3"
                                id="gender" required>
                                <option value=""></option>
                                <option value="male">Masculino</option>
                                <option value="female">Feminino</option>
                            </select>
                            <label for="gender">Sexo</label>

                            <input type="text" class="form-control mb-3 date" 
                                id="birthdate" name="birthdate" required>
                            <label for="birthdate">Data de nascimento</label>

                            <input type="text" class="form-control mb-3 phone" 
                                id="phone" name="phone" required>
                            <label for="phone">Telefone</label>
                            
                            <a class="btn btn-primary w-100 finish">Continuar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php wp_footer() ?>
</body>
</html>