<footer class="main-footer">
    <div class="container wrap">
        <div class="main-footer__menus">
            <?php
            $menu_items = get_menu_items('menu_header');
            if (count($menu_items) > 0) :
            ?>
                <ul class="main-footer__links">
                    <?php foreach ($menu_items as $item) : ?>
                        <li><a href="<?php echo $item->url; ?>" title="<?php echo $item->title; ?>" aria-label="Ir para a página <?php echo $item->title; ?>" class=""><?php echo $item->title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <ul class="main-footer__social">
                <?php if (isset(get_option('opt_page_theme_options')['whatsapp'])) : ?>
                    <li class="main-footer__social-item">
                        <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['whatsapp'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-whatsapp.svg" alt=""></a>
                    </li>
                <?php endif; ?>
                <?php if (isset(get_option('opt_page_theme_options')['facebook'])) : ?>
                    <li class="main-footer__social-item">
                        <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['facebook'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-facebook.svg" alt=""></a>
                    </li>
                <?php endif; ?>
                <?php if (isset(get_option('opt_page_theme_options')['instagram'])) : ?>
                    <li class="main-footer__social-item">
                        <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['instagram'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-instagram.svg" alt=""></a>
                    </li>
                <?php endif; ?>
                <?php if (isset(get_option('opt_page_theme_options')['linkedin'])) : ?>
                    <li class="main-footer__social-item">
                        <a target="_blank" href="<?php echo get_option('opt_page_theme_options')['linkedin'] ?>"><img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-linkeding.svg" alt=""></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <?php if (isset(get_option('opt_page_theme_options')['texto_footer'])) : ?>
            <div class="main-footer__text">
                <?php echo wpautop(get_option('opt_page_theme_options')['texto_footer']); ?>
            </div>
        <?php endif; ?>
        <div class="main-footer__logo">
            <img src="<?php echo get_template_directory_uri() ?>/dist/images/icon-pontte-gray.svg" alt="Ícone Pontte">
        </div>
    </div>
</footer>

<script src="<?php echo get_template_directory_uri() ?>/dist/js/main.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>