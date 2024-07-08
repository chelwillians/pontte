<?php

/* Template Name: Seja um parceiro */

get_header();
?>

<section class="internal-banner">
    <div class="internal-banner__image">
        <img src="<?php echo !empty(get_field('imagem_desktop')) ? get_field('imagem_desktop') : get_template_directory_uri() . '/dist/images/internal-banner.png' ?>" alt="Banner interno">
    </div>
    <div class="container wrap">
        <div class="internal-banner__content">
            <?php if (!empty(get_field('titulo'))) : ?>
                <h1 class="internal-banner__title"><?php echo get_field('titulo') ?></h1>
            <?php else : ?>
                <h1 class="internal-banner__title">O caminho para <br>criar o <strong>seu futuro</strong></h1>
            <?php endif; ?>
            <?php if (!empty(get_field('descricao'))) : ?>
                <div class="internal-banner__desc">
                    <?php echo wpautop(get_field('descricao')); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(get_field('link_botao'))) : ?>
                <a href="<?php echo get_field('link_botao') ?>" class="internal-banner__button"><?php echo !empty(get_field('texto_botao')) ? get_field('texto_botao') : 'Quero ser parceiro' ?></a>
            <?php endif; ?>
        </div>
    </div>
    <a href="#" class="internal-banner__arrow-down">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/arrow-down-2.svg" alt="Seta apontando para baixo">
    </a>
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/message-rounded.png" class="internal-banner__float-item internal-banner__float-item--message" alt="Dado rotativo">
</section>

<?php if (!empty(get_field('exibir_o_futuro'))) : ?>
    <section class="the-future" id="the-future">
        <div class="container wrap">
            <?php if (!empty(get_field('link_botao'))) : ?>
                <h2 class="the-future__title"><?php echo get_field('titulo_o_futuro'); ?></h2>
            <?php endif; ?>

            <div class="the-future__list">
                <?php foreach (get_field('lista_o_futuro') as $item) : ?>
                    <div class="the-future__item">
                        <h3 class="the-future__item--title"><?php echo $item['titulo'] ?></h3>
                        <div class="the-future__item--desc">
                            <?php echo wpautop($item['descricao']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-8.svg" class="the-future__float-item the-future__float-item--top-left" alt="Quadrado flutuante">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-9.svg" class="the-future__float-item the-future__float-item--bottom-right" alt="Quadrado flutuante">
    </section>
<?php endif; ?>

<?php if (!empty(get_field('exibir_beneficios'))) : ?>
    <section class="benefits">
        <div class="container wrap">
            <div class="benefits__left">
                <?php if (!empty(get_field('titulo_beneficios'))) : ?>
                    <h2 class="benefits__title"><?php echo get_field('titulo_beneficios'); ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field('descricao_beneficios'))) : ?>
                    <div class="benefits__desc">
                        <?php echo wpautop(get_field('descricao_beneficios')); ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty(get_field('link_botao_beneficios'))) : ?>
                    <a href="<?php echo get_field('link_botao_beneficios'); ?>" class="benefits__button"><?php echo !empty(get_field('texto_botao_beneficios')) ? get_field('texto_botao_beneficios') : 'Quero ser parceiro'; ?></a>
                <?php endif; ?>
            </div>

            <?php if (!empty(get_field('conteudo_flutuante_beneficios'))) : ?>
                <div class="benefits__info">
                    <div class="benefits__info--icon">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte.svg" alt="Ícone pontte">
                    </div>
                    <div class="benefits__info--desc">
                        <?php echo wpautop(get_field('conteudo_flutuante_beneficios')); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="benefits__list">
                <?php foreach (get_field('lista_beneficios') as $item) : ?>
                    <div class="benefits__item">
                        <div class="benefits__item--icon">
                            <img src="<?php echo !empty($item['icone']) ? $item['icone'] : get_template_directory_uri() . '/dist/images/icon-percent.svg' ?>" alt="Ícone">
                        </div>
                        <div class="benefits__item--text">
                            <h3 class="benefits__item--title"><?php echo $item['texto_um'] ?> <strong><?php echo $item['texto_dois'] ?></strong></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field('exibir_etapas'))) : ?>
    <section class="steps">
        <div class="container wrap">
            <div class="steps__header">
                <a href="#" class="steps__arrow-down">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/arrow-down-2.svg" alt="Seta apontando para baixo">
                </a>
                <?php if (!empty(get_field('titulo_etapas'))) : ?>
                    <h2 class="steps__title"><?php echo get_field('titulo_etapas') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field('link_etapas'))) : ?>
                    <a href="<?php echo get_field('link_etapas') ?>" class="steps__button"><?php echo !empty(get_field('texto_botao_etapas')) ? get_field('texto_botao_etapas') : 'Quero ser um parceiro Pontte' ?></a>
                <?php endif; ?>
            </div>

            <div class="steps__cards">
                <?php foreach (get_field('cards_list_etapas') as $item) : ?>
                    <div class="steps__item">
                        <div class="steps__item--icon">
                            <img src="<?php echo !empty($item['icon_card']) ? $item['icon_card'] : get_template_directory_uri() . '/dist/images/icon-1.svg' ?>" alt="Ícone">
                        </div>
                        <?php if (!empty($item['titulo'])) : ?>
                            <h3 class="steps__item--title"><?php echo $item['titulo'] ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($item['descricao'])) : ?>
                            <div class="steps__item--desc">
                                <?php echo wpautop($item['descricao']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('exibir_depoimentos')) : ?>
    <section class="testimonials">
        <div class="container wrap">
            <?php if (!empty(get_field('pretitulo_depoimentos'))) : ?>
                <strong class="testimonials__pre-title"><?php echo get_field('pretitulo_depoimentos') ?></strong>
            <?php endif; ?>
            <?php if (!empty(get_field('titulo_depoimentos'))) : ?>
                <h2 class="testimonials__title"><?php echo get_field('titulo_depoimentos') ?></h2>
            <?php endif; ?>
        </div>
        <div class="testimonials__list swiper">
            <div class="swiper-wrapper">
                <?php foreach (get_field('lista_depoimentos') as $depoimento) : ?>
                    <div class="testimonials__item swiper-slide">
                        <div class="testimonials__item--wrap">
                            <?php echo wpautop($depoimento['texto']) ?>
                            <strong><?php echo $depoimento['autor'] ?></strong>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('exibir_timeline')) : ?>
    <section class="timeline">
        <div class="container wrap">
            <div class="timeline__left">
                <div class="timeline__content">
                    <?php if (get_field('titulo_timeline')) : ?>
                        <h2 class="timeline__title"><?php echo get_field('titulo_timeline') ?></h2>
                    <?php else : ?>
                        <h2 class="timeline__title"><strong>Desde 2018,</strong> conectando pessoas e empresas ao <strong>futuro</strong></h2>
                    <?php endif; ?>
                    <?php if (get_field('descricao_timeline')) : ?>
                        <div class="timeline__desc">
                            <?php echo wpautop(get_field('descricao_timeline')) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <img class="timeline__image" src="<?php echo get_field('imagem_timeline') ? get_field('imagem_timeline') : get_template_directory_uri() . '/dist/images/image-timeline.png' ?>" alt="Imagem da seção">
            </div>
            <div class="timeline__list">
                <?php foreach (get_field('lista_timeline') as $item) : ?>
                    <div class="timeline__item">
                        <div class="timeline__item--year"><?php echo $item['ano'] ?></div>
                        <div class="timeline__item--desc">
                            <?php echo wpautop($item['descricao']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="partners">
    <div class="container wrap">
        <h2 class="partners__title">Conheça nossos <strong>parceiros</strong></h2>

        <div class="partners__list swiper">
            <div class="swiper-wrapper">
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-1.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-2.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-3.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-4.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-5.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-6.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-7.png" alt="">
                </div>
                <div class="partners__item swiper-slide">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/logos/logo-8.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="price">
    <div class="container wrap">
        <div class="price__left">
            <h2 class="price__title"><strong>A Pontte é o caminho</strong> para criar o seu futuro</h2>
            <div class="price__desc">
                <p>Nossos números comprovam mês a mês que nosso plano está dando certo. Oferecer crédito justo,
                    fácil e sem burocracias está mudando o futuro de muitas pessoas.
                    <strong>E também pode mudar o seu.</strong>
                </p>
            </div>
            <a href="#" class="price__button">Quero mudar o meu futuro</a>
        </div>
        <div class="price__right">
            <strong class="price__pre-price">A Pontte já concedeu mais de</strong>
            <div class="price__value">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/price.svg" alt="Imagem do valor">
            </div>
            <span class="price__after-price"><strong>MILHÕES</strong> em crédito imobiliário</span>
        </div>
    </div>
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-10.svg" class="price__float-item" alt="Ícone quadrado flutuante">
</section>


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