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
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-3.svg" class="main-hero__float-item main-hero__float-item--desktop-bottom" alt="Ícone flutuante">
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
                <img src="<?php echo !empty(get_field('imagem_desk_sobre')) ? get_field('imagem_desk_sobre') : get_template_directory_uri() . '/dist/images/about.jpg' ?>" alt="" class="about__image--desktop">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte-gray.svg" alt="Ícone Pontte em cinza" class="about__image--icon">
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
            </div>
            <div class="home-equity__side">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/home-equity-mobile.png" alt="" class="home-equity__image home-equity__image--mobile">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/home-equity-desktop.png" alt="" class="home-equity__image home-equity__image--desktop">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte-gray.svg" alt="Ícone Pontte em cinza" class="home-equity__image home-equity__image--icon">
            </div>
        </div>
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-4.svg" class="home-equity__float-item home-equity__float-item--mobile" alt="Ícone quadrado flutuante">
        <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-5.svg" class="home-equity__float-item home-equity__float-item--desktop" alt="Ícone quadrado flutuante">
    </section>
<?php endif; ?>

<section class="faq">
    <div class="container wrap">
        <strong class="faq__pre-title">O que você precisa saber</strong>
        <h2 class="faq__title"><strong>Dúvidas </strong>Frequentes</h2>

        <div class="faq__list">
            <div class="faq__item">
                <strong class="faq__item--question">Quem somos? <div class="faq__item--icon"></div>
                </strong>
                <div class="faq__item--answer">
                    <p>A Pontte é uma fintech que nasceu em 2018 como um braço de real state da Mauá Capital (agora
                        Jive
                        Mauá) com o objetivo de tornar a experiência de crédito imobiliário mais rápida e menos
                        burocrática.</p>

                    <p>Dizemos isso porque somos a primeira instituição financeira a emitir uma CCI (Cédula de
                        Crédito Imobiliário) digital no Brasil. Ou seja, o nosso processo é 100% online.
                        Em 2019, iniciamos a nossa operação ofertando Crédito com Garantia de Imóvel. Só neste ano,
                        tivemos mais de R$ 1.7 bilhões em solicitações de crédito. Também temos um funding próprio e
                        todo o dinheiro envolvido nas operações vem da Pontte.</p>

                    <p>Já em 2020, recebemos um aporte de R$ 160 milhões A partir de 2021 o parceiro (B2B) se
                        tornou o nosso foco. Nos anos seguintes, estreitamos a relação com estes parceiros, criamos
                        a
                        Central do Parceiro, que é a nossa plataforma oficial para indicação de leads, além de
                        melhorarmos os processos da nossa esteira de crédito.</p>

                    <p>Em 2024 migramos para o ecossistema da Galapagos Capital e além de Home Equity podemos
                        ofertar outras soluções financeiras aos nossos clientes.</p>
                </div>
            </div>
            <div class="faq__item">
                <strong class="faq__item--question">Confiança e transparência estão no nosso DNA <div class="faq__item--icon"></div>
                </strong>
                <div class="faq__item--answer">
                    <p>A Pontte é uma fintech que nasceu em 2018 como um braço de real state da Mauá Capital (agora
                        Jive
                        Mauá) com o objetivo de tornar a experiência de crédito imobiliário mais rápida e menos
                        burocrática.</p>

                    <p>Dizemos isso porque somos a primeira instituição financeira a emitir uma CCI (Cédula de
                        Crédito Imobiliário) digital no Brasil. Ou seja, o nosso processo é 100% online.
                        Em 2019, iniciamos a nossa operação ofertando Crédito com Garantia de Imóvel. Só neste ano,
                        tivemos mais de R$ 1.7 bilhões em solicitações de crédito. Também temos um funding próprio e
                        todo o dinheiro envolvido nas operações vem da Pontte.</p>

                    <p>Já em 2020, recebemos um aporte de R$ 160 milhões A partir de 2021 o parceiro (B2B) se
                        tornou o nosso foco. Nos anos seguintes, estreitamos a relação com estes parceiros, criamos
                        a
                        Central do Parceiro, que é a nossa plataforma oficial para indicação de leads, além de
                        melhorarmos os processos da nossa esteira de crédito.</p>

                    <p>Em 2024 migramos para o ecossistema da Galapagos Capital e além de Home Equity podemos
                        ofertar outras soluções financeiras aos nossos clientes.</p>
                </div>
            </div>
            <div class="faq__item">
                <strong class="faq__item--question">Qual a diferença entre a Pontte e um Banco? <div class="faq__item--icon"></div>
                </strong>
                <div class="faq__item--answer">
                    <p>A Pontte é uma fintech que nasceu em 2018 como um braço de real state da Mauá Capital (agora
                        Jive
                        Mauá) com o objetivo de tornar a experiência de crédito imobiliário mais rápida e menos
                        burocrática.</p>

                    <p>Dizemos isso porque somos a primeira instituição financeira a emitir uma CCI (Cédula de
                        Crédito Imobiliário) digital no Brasil. Ou seja, o nosso processo é 100% online.
                        Em 2019, iniciamos a nossa operação ofertando Crédito com Garantia de Imóvel. Só neste ano,
                        tivemos mais de R$ 1.7 bilhões em solicitações de crédito. Também temos um funding próprio e
                        todo o dinheiro envolvido nas operações vem da Pontte.</p>

                    <p>Já em 2020, recebemos um aporte de R$ 160 milhões A partir de 2021 o parceiro (B2B) se
                        tornou o nosso foco. Nos anos seguintes, estreitamos a relação com estes parceiros, criamos
                        a
                        Central do Parceiro, que é a nossa plataforma oficial para indicação de leads, além de
                        melhorarmos os processos da nossa esteira de crédito.</p>

                    <p>Em 2024 migramos para o ecossistema da Galapagos Capital e além de Home Equity podemos
                        ofertar outras soluções financeiras aos nossos clientes.</p>
                </div>
            </div>
            <div class="faq__item">
                <strong class="faq__item--question">Diferenciais dos nossos produtos <div class="faq__item--icon">
                    </div>
                </strong>
                <div class="faq__item--answer">
                    <p>A Pontte é uma fintech que nasceu em 2018 como um braço de real state da Mauá Capital (agora
                        Jive
                        Mauá) com o objetivo de tornar a experiência de crédito imobiliário mais rápida e menos
                        burocrática.</p>

                    <p>Dizemos isso porque somos a primeira instituição financeira a emitir uma CCI (Cédula de
                        Crédito Imobiliário) digital no Brasil. Ou seja, o nosso processo é 100% online.
                        Em 2019, iniciamos a nossa operação ofertando Crédito com Garantia de Imóvel. Só neste ano,
                        tivemos mais de R$ 1.7 bilhões em solicitações de crédito. Também temos um funding próprio e
                        todo o dinheiro envolvido nas operações vem da Pontte.</p>

                    <p>Já em 2020, recebemos um aporte de R$ 160 milhões A partir de 2021 o parceiro (B2B) se
                        tornou o nosso foco. Nos anos seguintes, estreitamos a relação com estes parceiros, criamos
                        a
                        Central do Parceiro, que é a nossa plataforma oficial para indicação de leads, além de
                        melhorarmos os processos da nossa esteira de crédito.</p>

                    <p>Em 2024 migramos para o ecossistema da Galapagos Capital e além de Home Equity podemos
                        ofertar outras soluções financeiras aos nossos clientes.</p>
                </div>
            </div>
            <div class="faq__item">
                <strong class="faq__item--question">Crédito com Garantia de Imóvel <div class="faq__item--icon">
                    </div>
                </strong>
                <div class="faq__item--answer">
                    <p>A Pontte é uma fintech que nasceu em 2018 como um braço de real state da Mauá Capital (agora
                        Jive
                        Mauá) com o objetivo de tornar a experiência de crédito imobiliário mais rápida e menos
                        burocrática.</p>

                    <p>Dizemos isso porque somos a primeira instituição financeira a emitir uma CCI (Cédula de
                        Crédito Imobiliário) digital no Brasil. Ou seja, o nosso processo é 100% online.
                        Em 2019, iniciamos a nossa operação ofertando Crédito com Garantia de Imóvel. Só neste ano,
                        tivemos mais de R$ 1.7 bilhões em solicitações de crédito. Também temos um funding próprio e
                        todo o dinheiro envolvido nas operações vem da Pontte.</p>

                    <p>Já em 2020, recebemos um aporte de R$ 160 milhões A partir de 2021 o parceiro (B2B) se
                        tornou o nosso foco. Nos anos seguintes, estreitamos a relação com estes parceiros, criamos
                        a
                        Central do Parceiro, que é a nossa plataforma oficial para indicação de leads, além de
                        melhorarmos os processos da nossa esteira de crédito.</p>

                    <p>Em 2024 migramos para o ecossistema da Galapagos Capital e além de Home Equity podemos
                        ofertar outras soluções financeiras aos nossos clientes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="midia">
    <div class="container wrap">
        <h2 class="midia__title">Pontte na <strong>mídia</strong></h2>
        <div class="midia__list swiper">
            <div class="swiper-wrapper">
                <div class="midia__item swiper-slide">
                    <div class="midia__item--logo">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo-valor-economico.png" alt="Logo Economico Valor">
                    </div>
                </div>
                <div class="midia__item swiper-slide">
                    <div class="midia__item--logo">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo-forbes.png" alt="Logo Economico forbes">
                    </div>
                </div>
                <div class="midia__item swiper-slide">
                    <div class="midia__item--logo">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo-valor-economico.png" alt="Logo Economico Valor">
                    </div>
                </div>
                <div class="midia__item swiper-slide">
                    <div class="midia__item--logo">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo-forbes.png" alt="Logo Economico forbes">
                    </div>
                </div>
                <div class="midia__item swiper-slide">
                    <div class="midia__item--logo">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo-valor-economico.png" alt="Logo Economico Valor">
                    </div>
                </div>
                <div class="midia__item swiper-slide">
                    <div class="midia__item--logo">
                        <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo-forbes.png" alt="Logo Economico forbes">
                    </div>
                </div>
            </div>
        </div>
        <div class="midia__content-list">
            <div class="midia__content-item">
                <div class="midia__content-item--data">
                    <span class="month">FEV</span>
                    <span class="year">2022</span>
                </div>
                <div class="midia__content-item--text">
                    <p>1Recentemente, a Pontte liderou um grupo que incluiu a Vórtx DTVM, a QI Tech, a Uniproof e a
                        Mauá Capital, e desenvolveu o conceito que tornou realidade a emissão de CCIs 100%
                        eletrônicas. A B3, na qualidade de câmara registradora e de negociação das CCIs, concedeu a
                        autorização inédita em agosto de 2020 e isso agora passa a ser realidade para todos os
                        participantes desse mercado. Isso significa mais agilidade e menos custos para o tomador de
                        crédito no Brasil.</p>
                </div>
                <a href="#" class="midia__content-item--link">
                    <span>Acesse a notícia</span>
                </a>
            </div>
            <div class="midia__content-item">
                <div class="midia__content-item--data">
                    <span class="month">MAR</span>
                    <span class="year">2022</span>
                </div>
                <div class="midia__content-item--text">
                    <p>2Recentemente, a Pontte liderou um grupo que incluiu a Vórtx DTVM, a QI Tech, a Uniproof e a
                        Mauá Capital, e desenvolveu o conceito que tornou realidade a emissão de CCIs 100%
                        eletrônicas. A B3, na qualidade de câmara registradora e de negociação das CCIs, concedeu a
                        autorização inédita em agosto de 2020 e isso agora passa a ser realidade para todos os
                        participantes desse mercado. Isso significa mais agilidade e menos custos para o tomador de
                        crédito no Brasil.</p>
                </div>
                <a href="#" class="midia__content-item--link">
                    <span>Acesse a notícia</span>
                </a>
            </div>
            <div class="midia__content-item">
                <div class="midia__content-item--data">
                    <span class="month">ABR</span>
                    <span class="year">2022</span>
                </div>
                <div class="midia__content-item--text">
                    <p>3Recentemente, a Pontte liderou um grupo que incluiu a Vórtx DTVM, a QI Tech, a Uniproof e a
                        Mauá Capital, e desenvolveu o conceito que tornou realidade a emissão de CCIs 100%
                        eletrônicas. A B3, na qualidade de câmara registradora e de negociação das CCIs, concedeu a
                        autorização inédita em agosto de 2020 e isso agora passa a ser realidade para todos os
                        participantes desse mercado. Isso significa mais agilidade e menos custos para o tomador de
                        crédito no Brasil.</p>
                </div>
                <a href="#" class="midia__content-item--link">
                    <span>Acesse a notícia</span>
                </a>
            </div>
            <div class="midia__content-item">
                <div class="midia__content-item--data">
                    <span class="month">MAI</span>
                    <span class="year">2022</span>
                </div>
                <div class="midia__content-item--text">
                    <p>4Recentemente, a Pontte liderou um grupo que incluiu a Vórtx DTVM, a QI Tech, a Uniproof e a
                        Mauá Capital, e desenvolveu o conceito que tornou realidade a emissão de CCIs 100%
                        eletrônicas. A B3, na qualidade de câmara registradora e de negociação das CCIs, concedeu a
                        autorização inédita em agosto de 2020 e isso agora passa a ser realidade para todos os
                        participantes desse mercado. Isso significa mais agilidade e menos custos para o tomador de
                        crédito no Brasil.</p>
                </div>
                <a href="#" class="midia__content-item--link">
                    <span>Acesse a notícia</span>
                </a>
            </div>
            <div class="midia__content-item">
                <div class="midia__content-item--data">
                    <span class="month">JUN</span>
                    <span class="year">2022</span>
                </div>
                <div class="midia__content-item--text">
                    <p>5Recentemente, a Pontte liderou um grupo que incluiu a Vórtx DTVM, a QI Tech, a Uniproof e a
                        Mauá Capital, e desenvolveu o conceito que tornou realidade a emissão de CCIs 100%
                        eletrônicas. A B3, na qualidade de câmara registradora e de negociação das CCIs, concedeu a
                        autorização inédita em agosto de 2020 e isso agora passa a ser realidade para todos os
                        participantes desse mercado. Isso significa mais agilidade e menos custos para o tomador de
                        crédito no Brasil.</p>
                </div>
                <a href="#" class="midia__content-item--link">
                    <span>Acesse a notícia</span>
                </a>
            </div>
            <div class="midia__content-item">
                <div class="midia__content-item--data">
                    <span class="month">JUL</span>
                    <span class="year">2022</span>
                </div>
                <div class="midia__content-item--text">
                    <p>6Recentemente, a Pontte liderou um grupo que incluiu a Vórtx DTVM, a QI Tech, a Uniproof e a
                        Mauá Capital, e desenvolveu o conceito que tornou realidade a emissão de CCIs 100%
                        eletrônicas. A B3, na qualidade de câmara registradora e de negociação das CCIs, concedeu a
                        autorização inédita em agosto de 2020 e isso agora passa a ser realidade para todos os
                        participantes desse mercado. Isso significa mais agilidade e menos custos para o tomador de
                        crédito no Brasil.</p>
                </div>
                <a href="#" class="midia__content-item--link">
                    <span>Acesse a notícia</span>
                </a>
            </div>
        </div>
    </div>
    <img src="<?php echo get_template_directory_uri() ?>/dist/images/float-icon-6.svg" class="midia__float-item" alt="Ícone quadrado flutuante">
</section>

<?php get_footer(); ?>