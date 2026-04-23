<?php
declare(strict_types=1);

get_header();

$practice_area_key = (string) get_post_meta(get_the_ID(), 'memphislaw_practice_area_key', true);

if ($practice_area_key === '') {
    $practice_area_key = (string) get_post_field('post_name', get_the_ID());
}

$practice_area = memphislaw_get_practice_area_page($practice_area_key);

if (is_array($practice_area)) {
    get_template_part('template-parts/practice-area-page', null, ['practice_area' => $practice_area]);
    get_footer();
    return;
}
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
