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

<section class="benefits">
    <div class="container wrap">
        <div class="benefits__left">
            <h2 class="benefits__title">Com a Pontte, <strong>você</strong> e o <strong>seu cliente ganham</strong>
            </h2>
            <div class="benefits__desc">
                <p>Aqui o seu cliente pode usar um imóvel como garantia e obter crédito com as melhores taxas e
                    condições de pagamento - tudo isso com rapidez, facilidade e segurança.</p>
            </div>
            <a href="#" class="benefits__button">Quero ser parceiro</a>
        </div>

        <div class="benefits__info">
            <div class="benefits__info--icon">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte.svg" alt="Ícone pontte">
            </div>
            <div class="benefits__info--desc">
                <p><strong>Seu cliente consegue crédito</strong> para fazer o que precisa.</p>
                <p><strong>Você ganha comissão</strong> para aproveitar o agora.</p>
            </div>
        </div>

        <div class="benefits__list">
            <div class="benefits__item">
                <div class="benefits__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-percent.svg" alt="">
                </div>
                <div class="benefits__item--text">
                    <h3 class="benefits__item--title">Taxas a partir de <strong>1,09% ao mês + IPCA</strong></h3>
                </div>
            </div>
            <div class="benefits__item">
                <div class="benefits__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-calendar.svg" alt="">
                </div>
                <div class="benefits__item--text">
                    <h3 class="benefits__item--title">Carência de até <strong>2 meses</strong></h3>
                </div>
            </div>
            <div class="benefits__item">
                <div class="benefits__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-star.svg" alt="">
                </div>
                <div class="benefits__item--text">
                    <h3 class="benefits__item--title">Imóveis avaliados a partir de <strong>R$ 200 mil</strong></h3>
                </div>
            </div>
            <div class="benefits__item">
                <div class="benefits__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-house.svg" alt="">
                </div>
                <div class="benefits__item--text">
                    <h3 class="benefits__item--title">Crédito de até <strong>50% do valor do imóvel</strong></h3>
                </div>
            </div>
            <div class="benefits__item">
                <div class="benefits__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-clock.svg" alt="">
                </div>
                <div class="benefits__item--text">
                    <h3 class="benefits__item--title">Prazo de <strong>60 até 240 meses para pagar</strong></h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="steps">
    <div class="container wrap">
        <div class="steps__header">
            <a href="#" class="steps__arrow-down">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/arrow-down-2.svg" alt="Seta apontando para baixo">
            </a>
            <h2 class="steps__title">Quer ser um parceiro Pontte?<br><strong>É fácil. É rápido!</strong> Descubra
                como
                funciona</h2>
            <a href="#" class="steps__button">Quero ser um parceiro Pontte</a>
        </div>

        <div class="steps__cards">
            <div class="steps__item">
                <div class="steps__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-1.svg" alt="">
                </div>
                <h3 class="steps__item--title">Cadastro</h3>
                <div class="steps__item--desc">
                    <p>Você preenche o formulário e nós entramos em contato para agendar uma conversa.</p>
                </div>
            </div>
            <div class="steps__item">
                <div class="steps__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-2.svg" alt="">
                </div>
                <h3 class="steps__item--title">Contrato</h3>
                <div class="steps__item--desc">
                    <p>Durante a assinatura do contrato oferecemos todo o apoio necessário para sanar dúvidas e
                        explicar como funciona a nossa esteira.</p>
                </div>
            </div>
            <div class="steps__item">
                <div class="steps__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-3.svg" alt="">
                </div>
                <h3 class="steps__item--title">Indicações</h3>
                <div class="steps__item--desc">
                    <p>Com o contrato assinado, é hora de agir! Você pode indicar operações e ajudar seus clientes a
                        obter crédito com facilidade.</p>
                </div>
            </div>
            <div class="steps__item">
                <div class="steps__item--icon">
                    <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-4.svg" alt="">
                </div>
                <h3 class="steps__item--title">Crédito liberado</h3>
                <div class="steps__item--desc">
                    <p>Com a operação concluída, o crédito é liberado para o cliente e você ganha seu repasse, após
                        os trâmites legais.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials">
    <div class="container wrap">
        <strong class="testimonials__pre-title">Parceiros</strong>
        <h2 class="testimonials__title"><strong>Faça parte</strong> da Pontte</h2>
    </div>
    <div class="testimonials__list swiper">
        <div class="swiper-wrapper">
            <div class="testimonials__item swiper-slide">
                <div class="testimonials__item--wrap">
                    <p>"É um prazer e satisfação fazer parte desta instituição financeira que, para nós, é
                        considerada
                        nossa família. Não há palavras suficientes para expressar nossa gratidão pela dedicação
                        incansável que vocês têm com a minha empresa. Só posso dizer uma coisa: obrigado,
                        Pontte,
                        por
                        acreditar em nosso trabalho."</p>
                    <strong>Rodolfo - R3R Assessoria</strong>
                </div>
            </div>
            <div class="testimonials__item swiper-slide">
                <div class="testimonials__item--wrap">
                    <p>"O diferencial da Pontte é o atendimento. Eles estão sempre prestativos por WhatsApp ou
                        por
                        telefone, e temos acesso desde a pessoa que faz o operacional até o CEO.  Outro
                        diferencial
                        é a
                        parte de comissionamento, a rapidez dos processo e a possibilidade de poder defender uma
                        proposta. Ou seja, a Pontte dá abertura pra gente flexibilizar e defender o cliente e, é
                        lógico,
                        soltar essa operação e todo mundo ficar contente: o cliente, o parceiro que me trouxe a
                        indicação, a Pontte e a minha empresa."</p>
                    <strong>Eduardo Gelm Goi</strong>
                </div>
            </div>
            <div class="testimonials__item swiper-slide">
                <div class="testimonials__item--wrap">
                    <p>"Enquanto temos no mercado grandes bancos que trabalham com esteiras travadas e sem
                        flexibilidade, na Pontte conseguimos fazer um trabalho absolutamente personalizado. Eu
                        consigo
                        que o analista converse comigo e entenda o cliente, o negócio do cliente e a fonte de
                        renda
                        dele. Isso dá uma condição completamente diferente que eu não consigo em uma instituição
                        financeira padrão."</p>
                    <strong>Paulo - My Side</strong>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="timeline">
    <div class="container wrap">
        <div class="timeline__left">
            <div class="timeline__content">
                <h2 class="timeline__title"><strong>Desde 2018,</strong> conectando pessoas e empresas ao
                    <strong>futuro</strong>
                </h2>
                <div class="timeline__desc">
                    <p>Conheça um pouco da nossa história</p>
                </div>
            </div>
            <img class="timeline__image" src="<?php echo get_template_directory_uri() ?>/dist/images/image-timeline.png" alt="">
        </div>
        <div class="timeline__list">
            <div class="timeline__item">
                <div class="timeline__item--year">2018</div>
                <div class="timeline__item--desc">
                    <p>A Pontte é fundada como uma fintech de crédito imobiliário</p>
                </div>
            </div>
            <div class="timeline__item">
                <div class="timeline__item--year">2019</div>
                <div class="timeline__item--desc">
                    <p>Iniciamos nossa operação e fechamos nossos primeiros contratos de crédito com garantia de
                        imóvel</p>
                </div>
            </div>
            <div class="timeline__item">
                <div class="timeline__item--year">2020</div>
                <div class="timeline__item--desc">
                    <p>Tivemos nossa primeira rodada de investimento, de <strong>R$ 160 milhões</strong></p>
                </div>
            </div>
            <div class="timeline__item">
                <div class="timeline__item--year">2022</div>
                <div class="timeline__item--desc">
                    <p>Estreitamos os laços com nossos parceiros e garantimos comissões mais competitivas</p>
                </div>
            </div>
            <div class="timeline__item">
                <div class="timeline__item--year">2023</div>
                <div class="timeline__item--desc">
                    <p>Mais de 90% das operações que recebemos foram via parceiros</p>
                </div>
            </div>
            <div class="timeline__item">
                <div class="timeline__item--year">2024</div>
                <div class="timeline__item--desc">
                    <p>Migramos para o ecossistema da Galapagos Capital</p>
                </div>
            </div>
        </div>
    </div>
</section>

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