<?php
declare(strict_types=1);

get_header();
?>
<main id="primary" class="site-main site-main--simple">
    <div class="container content-shell">
        <?php if (have_posts()) : ?>
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
        <?php else : ?>
            <article class="entry-card">
                <h1><?php esc_html_e('Nothing found', 'memphislaw'); ?></h1>
                <p><?php esc_html_e('This page is ready for content once the WordPress site is activated and seeded.', 'memphislaw'); ?></p>
            </article>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();
