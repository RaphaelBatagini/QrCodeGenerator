<form class="form form-steps col-12" method="post" 
    action="<?= admin_url('admin-post.php') ?>">
    <input type="hidden" name="action" 
        value="discount_partner_register_user">
    <input type="hidden" name="discount_partner" 
        value="<?= get_the_ID() ?>">
    <div class="step row" data-step="1">
        <div class="col-12 pb-5">
            <h2 class="text-center">seja bem-vindo</h2>    
        </div>
        <div class="col-12 text-center pb-5">
            <img src="<?php the_post_thumbnail_url('thumbnail') ?>" 
            alt="<?php the_title() ?>" class="m-auto"/>
        </div>
        <div class="col-12 pb-5">
            <h1 class="text-center">Aproveite nossas promoções</h1>    
        </div>
        <div class="col-12 col-lg-4 offset-lg-4">
            <?php if(get_field('discount_percentage') && get_field('shelf_life')): ?>
            <div class="card card-coupon mb-4 next">
                <div class="card-header">
                    <h2 class="card-title"><?= get_field('discount_percentage') ?>% off</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">Clique aqui e gere seu <u>cupom</u></p>
                </div>
                <div class="card-footer">
                    válido até <?= get_field('shelf_life') ?>
                </div>
            </div>
            <?php else: ?>
                <h5>Nenhum desconto encontrado</h5>
            <?php endif ?>
        </div>
    </div>
    <div class="step row" data-step="2">
        <div class="col-12 text-center pb-5">
            <img src="<?php the_post_thumbnail_url('thumbnail') ?>" 
            alt="<?php the_title() ?>" class="m-auto"/>
        </div>
        <div class="col-12 text-center mb-5">
            <h1>Complete seu cadastro</h1>
        </div>
        <div class="col-lg-6 offset-lg-3">
            <div class="form-group">    
                <input type="email" class="form-control mb-3" 
                    id="email" name="email" required>
                <label class="mb-3" for="email">E-mail</label>
            </div>
            <a class="btn btn-primary w-100 next step-one-btn">Continuar</a>
        </div>
    </div>
    <div class="step row" data-step="3">
        <div class="col-12 text-center pb-5">
            <img src="<?php the_post_thumbnail_url('thumbnail') ?>" 
            alt="<?php the_title() ?>" class="m-auto"/>
        </div>
        <div class="col-12 col-lg-6 offset-lg-3">
            <h1 class="text-center mb-5">Complete seu cadastro</h1>
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
                <label class="mb-3" for="phone">Telefone</label>
            </div>
            <a class="btn btn-primary w-100 finish">Continuar</a>
        </div>
    </div>
</form>