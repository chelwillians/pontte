<?php get_header() ?>
<section class="the-page">
    <div class="container wrap">
        <h1 class="the-page__title"><?php echo get_the_title() ?></h1>
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</section>
<?php get_footer() ?>