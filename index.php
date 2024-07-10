<?php

/* Template Name: Homepage */

get_header();
?>

<section class="main-hero">
    <div class="container wrap">
        <div class="main-hero__content">
            <?php if (!empty(get_field('titulo'))) : ?>
                <h1 class="main-hero__title"><?php echo get_field('titulo'); ?></h1>
            <?php else : ?>
                <h1 class="main-hero__title"><strong class="purple">Crédito</strong> para <br>criar o <strong>seu futuro</strong></h1>
            <?php endif; ?>
            <?php if (!empty(get_field('descricao'))) : ?>
                <div class="main-hero__desc">
                    <?php echo wpautop(get_field('descricao')); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(get_field('link_botao'))) : ?>
                <a href="<?php echo get_field('link_botao'); ?>" class="main-hero__button"><?php echo !empty(get_field('texto_botao')) ? get_field('texto_botao') : 'Quero me cadastrar'; ?></a>
            <?php endif; ?>
        </div>
        <div class="main-hero__image">
            <img src="<?php echo !empty(get_field('imagem_desktop')) ? get_field('imagem_desktop') : get_template_directory_uri() . '/dist/images/banner.png'; ?>" class="main-hero__image--desktop" alt="Banner">
            <img src="<?php echo !empty(get_field('imagem_mobile')) ? get_field('imagem_mobile') : get_template_directory_uri() . '/dist/images/banner-mobile.png'; ?>" class="main-hero__image--mobile" alt="Banner">
        </div>
        <a href="#" class="main-hero__arrow-down">
            <img src="<?php echo get_template_directory_uri() ?>/dist/images/arrow-down.svg" alt="Seta apontando para baixo">
        </a>
    </div>
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon.svg" class="main-hero__float-item main-hero__float-item--mobile-top" alt="Ícone quadrado flutuante">
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-2.svg" class="main-hero__float-item main-hero__float-item--mobile-center" alt="Ícone retangular flutuante">
</section>

<?php if (get_field('exibir_divisor')) : ?>
    <section class="divider">
        <div class="container wrap">
            <?php if (!empty(get_field('titulo_divisor'))) : ?>
                <h2 class="divider__title"><?php echo get_field('titulo_divisor'); ?></h2>
            <?php else : ?>
                <h2 class="divider__title"><strong>Crédito</strong> para <br>concretizar planos</h2>
            <?php endif; ?>
            <?php if (!empty(get_field('descricao_divisor'))) : ?>
                <div class="divider__desc">
                    <?php echo wpautop(get_field('descricao_divisor')) ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(get_field('link_botao_divisor'))) : ?>
                <a href="<?php echo get_field('link_botao_divisor'); ?>" class="divider__button"><?php echo !empty(get_field('texto_botao_divisor')) ? get_field('texto_botao_divisor') : 'Tire suas dúvidas aqui' ?></a>
            <?php endif; ?>
        </div>
        <div class="divider__cards swiper">
            <div class="swiper-wrapper">
                <?php
                foreach (get_field('cards_list') as $card) : ?>
                    <div class="divider__cards-item swiper-slide">
                        <div class="divider__cards-icon">
                            <img src="<?php echo !empty($card['icon_card']) ? $card['icon_card'] : get_template_directory_uri() . '/dist/images/icon-calendar.svg' ?>" alt="Ícone">
                        </div>
                        <div class="divider__cards-text">
                            <?php if (!empty($card['texto_um'])) : ?>
                                <span class="divider__cards-text--min"><?php echo $card['texto_um']; ?></span>
                            <?php endif; ?>
                            <?php if (!empty($card['texto_dois'])) : ?>
                                <span class="divider__cards-text--normal"><?php echo $card['texto_dois']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('exibir_sobre')) : ?>
    <section class="about">
        <div class="container wrap">
            <div class="about__image">
                <img src="<?php echo !empty(get_field('imagem_mobile_sobre')) ? get_field('imagem_mobile_sobre') : get_template_directory_uri() . '/dist/images/about-mobile.jpg' ?>" alt="" class="about__image--mobile">
                <img src="<?php echo !empty(get_field('imagem_desk_sobre')) ? get_field('imagem_desk_sobre') : get_template_directory_uri() . '/dist/images/sobre.png' ?>" alt="" class="about__image--desktop">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte-gray.svg" alt="Ícone Pontte em cinza" class="about__image--icon">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-3.svg" class="about__float-item about__float-item--desktop-bottom" alt="Ícone flutuante">
            </div>
            <div class="about__content">
                <?php if (!empty(get_field('pretitulo_sobre'))) : ?>
                    <strong class="about__pre-title"><?php echo get_field('pretitulo_sobre') ?></strong>
                <?php endif; ?>
                <?php if (!empty(get_field('titulo_sobre'))) : ?>
                    <h2 class="about__title"><?php echo get_field('titulo_sobre') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field('descricao_sobre'))) : ?>
                    <div class="about__desc">
                        <?php echo wpautop(get_field('descricao_sobre')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="about__block">
                <?php if (!empty(get_field('titulo_2_sobre'))) : ?>
                    <?php echo wpautop(get_field('titulo_2_sobre')) ?>
                <?php endif; ?>
                <?php if (!empty(get_field('link_sobre'))) : ?>
                    <a href="<?php echo get_field('link_sobre') ?>" class="about__block--button"><?php echo !empty(get_field('texto_botao_sobre')) ? get_field('texto_botao_sobre') : 'Clique e veja como' ?></a>
                <?php endif; ?>
                <img class="about__block--image" src="<?php echo get_template_directory_uri() ?>/dist/images/coins.png" alt="Ilustração de moedas">
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field('exibir_para_voce'))) : ?>
    <div class="for-you">
        <div class="container wrap">
            <?php if (!empty(get_field('pretitulo_para_voce'))) : ?>
                <strong class="for-you__pre-title"><?php echo get_field('pretitulo_para_voce'); ?></strong>
            <?php endif; ?>
            <?php if (!empty(get_field('titulo_para_voce'))) : ?>
                <h2 class="for-you__title"><?php echo get_field('titulo_para_voce'); ?></h2>
            <?php endif; ?>
            <div class="for-you__cards">
                <?php foreach (get_field('cards_list_para_voce') as $card) : ?>
                    <div class="for-you__item">
                        <div class="for-you__item--icon">
                            <img src="<?php echo !empty($card['icon_card']) ? $card['icon_card'] : get_template_directory_uri() . '/dist/images/icon-checkbox.svg' ?>" alt="Ícone">
                        </div>
                        <?php if (!empty($card['titulo'])) : ?>
                            <h3 class="for-you__item--title"><?php echo $card['titulo']; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($card['descricao'])) : ?>
                            <div class="for-you__item--desc">
                                <?php echo wpautop($card['descricao']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty(get_field('exibir_home_equity'))) : ?>
    <section class="home-equity">
        <div class="container wrap">
            <div class="home-equity__content">
                <?php if (!empty(get_field('pretitulo_home_equity'))) : ?>
                    <strong class="home-equity__pre-title"><?php echo get_field('pretitulo_home_equity'); ?></strong>
                <?php endif; ?>
                <?php if (!empty(get_field('titulo_home_equity'))) : ?>
                    <h2 class="home-equity__title"><?php echo get_field('titulo_home_equity'); ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field('descricao_home_equity'))) : ?>
                    <div class="home-equity__desc">
                        <?php echo wpautop(get_field('descricao_home_equity')); ?>
                        <?php if (!empty(get_field('link_botao_home_equity'))) : ?>
                            <a href="<?php echo get_field('link_botao_home_equity'); ?>" class="home-equity__button"><?php echo !empty(get_field('texto_botao_home_equity')) ? get_field('texto_botao_home_equity') : 'Quero saber mais'; ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-5.svg" class="home-equity__float-item home-equity__float-item--desktop" alt="Ícone quadrado flutuante">
            </div>
            <div class="home-equity__side">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/home-equity-mobile.png" alt="" class="home-equity__image home-equity__image--mobile">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/home-equity-desktop.png" alt="" class="home-equity__image home-equity__image--desktop">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte-gray.svg" alt="Ícone Pontte em cinza" class="home-equity__image home-equity__image--icon">
            </div>
        </div>
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-4.svg" class="home-equity__float-item home-equity__float-item--mobile" alt="Ícone quadrado flutuante">
    </section>
<?php endif; ?>

<?php if (!empty(get_field('exibir_faq'))) : ?>
    <section class="faq">
        <div class="container wrap">
            <?php if (!empty(get_field('pretitulo_faq'))) : ?>
                <strong class="faq__pre-title"><?php echo get_field('pretitulo_faq'); ?></strong>
            <?php endif; ?>
            <?php if (!empty(get_field('titulo_faq'))) : ?>
                <h2 class="faq__title"><?php echo get_field('titulo_faq'); ?></h2>
            <?php endif; ?>

            <div class="faq__list">
                <?php foreach (get_field('faq_list') as $faq_item) : ?>
                    <div class="faq__item">
                        <strong class="faq__item--question"><?php echo $faq_item['pergunta']; ?> <div class="faq__item--icon"></div>
                        </strong>
                        <div class="faq__item--answer">
                            <?php echo wpautop($faq_item['resposta']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field('exibir_midia'))) : ?>
    <section class="midia">
        <div class="container wrap">
            <?php if (!empty(get_field('titulo_midia'))) : ?>
                <h2 class="midia__title"><?php echo get_field('titulo_midia'); ?></h2>
            <?php endif; ?>
            <div class="midia__list swiper">
                <div class="swiper-wrapper">
                    <?php foreach (get_field('midia_list') as $media_item) : ?>
                        <div class="midia__item swiper-slide">
                            <div class="midia__item--logo">
                                <img src="<?php echo !empty($media_item['logo']) ? $media_item['logo'] : get_template_directory_uri() . '/dist/images/logo-valor-economico.png' ?>" alt="Logo da matéria">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="midia__content-list">
                <?php foreach (get_field('midia_list') as $media_item) : ?>
                    <div class="midia__content-item">
                        <div class="midia__content-item--data">
                            <?php if (!empty($media_item['mes'])) : ?>
                                <span class="month"><?php echo $media_item['mes'] ?></span>
                            <?php endif; ?>
                            <?php if (!empty($media_item['ano'])) : ?>
                                <span class="year"><?php echo $media_item['ano'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="midia__content-item--text">
                            <?php echo wpautop($media_item['materia']) ?>
                        </div>
                        <?php if (!empty($media_item['link'])) : ?>
                            <a href="<?php echo $media_item['link'] ?>" class="midia__content-item--link">
                                <span>Acesse a notícia</span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-6.svg" class="midia__float-item" alt="Ícone quadrado flutuante">
    </section>
<?php endif; ?>

<?php get_footer(); ?>