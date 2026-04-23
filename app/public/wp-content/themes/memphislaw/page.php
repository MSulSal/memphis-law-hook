<?php
declare(strict_types=1);

get_header();
?>
<main id="primary" class="site-main site-main--simple">
    <div class="container content-shell">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('entry-card'); ?>>
                <header class="entry-card__header">
                    <h1><?php the_title(); ?></h1>
                </header>
                <div class="entry-card__content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php
get_footer();
