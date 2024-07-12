<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/dist/css/styles.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="main-header">
        <div class="container wrap">
            <a href="<?php echo get_home_url() ?>" class="main-header__logo">
                <img src="<?php echo !empty(get_option('opt_page_theme_options')['logo']) ? get_option('opt_page_theme_options')['logo'] : get_template_directory_uri() . '/dist/images/logo.svg' ?>" alt="Logo da marca">
            </a>
            <div class="main-header__menus">
                <?php
                $menu_items = get_menu_items('menu_header');
                if (count($menu_items) > 0) :
                ?>
                    <ul class="main-header__menus-item main-header__links">
                        <?php foreach ($menu_items as $item) : ?>
                            <li class="main-header__links-item">
                                <a href="<?php echo $item->url; ?>" title="<?php echo $item->title; ?>" aria-label="Ir para a página <?php echo $item->title; ?>" class=""><?php echo $item->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <ul class="main-header__social">
                    <?php if (isset(get_option('opt_page_theme_options')['whatsapp'])) : ?>
                        <li class="main-header__social-item">
                            <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['whatsapp'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-whatsapp.svg" alt=""></a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset(get_option('opt_page_theme_options')['facebook'])) : ?>
                        <li class="main-header__social-item">
                            <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['facebook'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-facebook.svg" alt=""></a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset(get_option('opt_page_theme_options')['instagram'])) : ?>
                        <li class="main-header__social-item">
                            <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['instagram'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-instagram.svg" alt=""></a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset(get_option('opt_page_theme_options')['linkedin'])) : ?>
                        <li class="main-header__social-item">
                            <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['linkedin'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-linkeding.svg" alt=""></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="main-header__hamburguer">
                <span></span>
            </div>
        </div>
    </header>