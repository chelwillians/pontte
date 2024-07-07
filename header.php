<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/dist/css/styles.min.css">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="main-header">
        <div class="container wrap">
            <div class="main-header__logo">
                <img src="<?php echo get_template_directory_uri() ?>/dist/images/logo.svg" alt="Logo da marca">
            </div>
            <div class="main-header__menus">
                <ul class="main-header__menus-item main-header__links">
                    <li class="main-header__links-item">
                        <a href="#" class="active">Home</a>
                    </li>
                    <li class="main-header__links-item">
                        <a href="#">Seja um parceiro</a>
                    </li>
                    <li class="main-header__links-item">
                        <a href="#">Contato</a>
                    </li>
                    <li class="main-header__links-item">
                        <a href="#">Termos de uso e privacidade</a>
                    </li>
                </ul>
                <ul class="main-header__social">
                    <li class="main-header__social-item">
                        <a href="#"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-whatsapp.svg" alt=""></a>
                    </li>
                    <li class="main-header__social-item">
                        <a href="#"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-facebook.svg" alt=""></a>
                    </li>
                    <li class="main-header__social-item">
                        <a href="#"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-instagram.svg" alt=""></a>
                    </li>
                    <li class="main-header__social-item">
                        <a href="#"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-linkeding.svg" alt=""></a>
                    </li>
                </ul>
            </div>
            <div class="main-header__hamburguer">
                <span></span>
            </div>
        </div>
    </header>