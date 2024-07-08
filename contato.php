<?php

/* Template Name: Contato */


get_header();
?>

<section class="main-contact">
    <div class="container wrap">
        <div class="main-contact__left">
            <div class="main-contact__text">
                <?php if (!empty(get_field('titulo_contato'))) : ?>
                    <h1 class="main-contact__title"><?php echo get_field('titulo_contato'); ?></h1>
                <?php else : ?>
                    <h1 class="main-contact__title">O futuro está a um clique de distância</h1>
                <?php endif; ?>
                <?php if (!empty(get_field('descricao_contato'))) : ?>
                    <div class="main-contact__desc">
                        <?php echo wpautop(get_field('descricao_contato')); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="main-contact__illustration">
                <img class="main-contact__illustration-img-mobile" src="<?php echo get_template_directory_uri() ?>/dist/images/rockeat-mobile.svg" alt="Foguete">
                <img class="main-contact__illustration-img-desk" src="<?php echo get_template_directory_uri() ?>/dist/images/rockeat.svg" alt="Foguete">
            </div>
        </div>
        <div class="main-contact__list">
            <div class="main-contact__item">
                <div class="main-contact__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-whatsapp.svg" alt="">
                </div>
                <div class="main-contact__item--content">
                    <h2 class="main-contact__item--title"><?php echo !empty(get_field('whatsapp_titulo_contato')) ? get_field('whatsapp_titulo_contato') : 'Fale com os nossos especialistas' ?></h2>
                    <?php if (!empty(get_field('whatsapp_conteudo_contato'))) : ?>
                        <div class="main-contact__item--data">
                            <?php echo wpautop(get_field('whatsapp_conteudo_contato')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="main-contact__item">
                <div class="main-contact__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-mail.svg" alt="">
                </div>
                <div class="main-contact__item--content">
                    <h2 class="main-contact__item--title"><?php echo !empty(get_field('email_titulo_contato')) ? get_field('email_titulo_contato') : 'Prefere conversar por e-mail?' ?></h2>
                    <?php if (!empty(get_field('email_conteudo_contato'))) : ?>
                        <div class="main-contact__item--data">
                            <?php echo wpautop(get_field('email_conteudo_contato')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="main-contact__item">
                <div class="main-contact__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-headphones.svg" alt="">
                </div>
                <div class="main-contact__item--content">
                    <h2 class="main-contact__item--title"><?php echo !empty(get_field('telefonar_titulo_contato')) ? get_field('telefonar_titulo_contato') : 'Quer telefonar?' ?></h2>
                    <?php if (!empty(get_field('telefonar_conteudo_contato'))) : ?>
                        <div class="main-contact__item--data">
                            <?php echo wpautop(get_field('telefonar_conteudo_contato')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="main-contact__item">
                <div class="main-contact__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-laptop.svg" alt="">
                </div>
                <div class="main-contact__item--content">
                    <h2 class="main-contact__item--title"><?php echo !empty(get_field('trabalhe_titulo_contato')) ? get_field('trabalhe_titulo_contato') : 'Trabalhe com a gente!' ?></h2>
                    <?php if (!empty(get_field('trabalhe_conteudo_contato'))) : ?>
                        <div class="main-contact__item--data">
                            <?php echo wpautop(get_field('trabalhe_conteudo_contato')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-11.svg" alt="" class="main-contact__float-icon main-contact__float-icon--one">
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-12.svg" alt="" class="main-contact__float-icon main-contact__float-icon--two">
</section>

<?php get_footer(); ?>