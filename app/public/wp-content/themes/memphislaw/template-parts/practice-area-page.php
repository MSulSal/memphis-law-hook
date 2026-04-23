<?php
declare(strict_types=1);

$practice_area = $args['practice_area'] ?? null;

if (!is_array($practice_area)) {
    return;
}

$contact = memphislaw_get_contact_details();
$related_areas = memphislaw_get_related_practice_areas($practice_area['slug']);
$editor_content = trim((string) get_the_content());
?>
<main id="primary" class="site-main practice-area-page">
    <section class="practice-hero practice-hero--<?php echo esc_attr($practice_area['slug']); ?>">
        <div class="practice-hero__overlay"></div>
        <div class="container practice-hero__inner">
            <div class="practice-hero__content">
                <nav class="practice-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'memphislaw'); ?>">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'memphislaw'); ?></a>
                    <span>/</span>
                    <a href="<?php echo esc_url(home_url('/#practice-areas')); ?>"><?php esc_html_e('Practice Areas', 'memphislaw'); ?></a>
                </nav>
                <p class="eyebrow"><?php echo esc_html($practice_area['eyebrow']); ?></p>
                <h1 class="practice-hero__title"><?php echo esc_html($practice_area['hero_title']); ?></h1>
                <p class="practice-hero__lead"><?php echo esc_html($practice_area['hero_summary']); ?></p>
                <div class="hero__actions">
                    <a class="button" href="<?php echo esc_url(memphislaw_get_consultation_url()); ?>">
                        <?php esc_html_e('Request a Consultation', 'memphislaw'); ?>
                    </a>
                    <a class="button button--ghost" href="<?php echo esc_url(memphislaw_get_phone_href()); ?>">
                        <?php echo esc_html(sprintf(__('Call %s', 'memphislaw'), $contact['phone'])); ?>
                    </a>
                </div>
            </div>

            <aside class="practice-hero__card">
                <h2><?php esc_html_e('Clients often call us about', 'memphislaw'); ?></h2>
                <ul class="practice-bullet-list">
                    <?php foreach ($practice_area['support_points'] as $point) : ?>
                        <li><?php echo esc_html($point); ?></li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </section>

    <section class="section section--dark">
        <div class="container">
            <div class="section__intro">
                <p class="eyebrow"><?php echo esc_html($practice_area['title']); ?></p>
                <h2><?php echo esc_html($practice_area['overview_heading']); ?></h2>
                <p><?php echo esc_html($practice_area['overview_copy']); ?></p>
            </div>

            <?php if ($editor_content !== '') : ?>
                <article class="entry-card practice-editor-content">
                    <div class="entry-card__content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endif; ?>

            <div class="practice-detail-grid">
                <?php foreach ($practice_area['case_cards'] as $card) : ?>
                    <article class="practice-detail-card">
                        <h3><?php echo esc_html($card['title']); ?></h3>
                        <p><?php echo esc_html($card['summary']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--blue">
        <div class="container practice-process">
            <div class="section__intro practice-process__intro">
                <p class="eyebrow"><?php esc_html_e('What to Expect', 'memphislaw'); ?></p>
                <h2><?php echo esc_html($practice_area['process_heading']); ?></h2>
                <p><?php esc_html_e('Clear communication and steady next steps matter as much as the legal paperwork. We aim to keep clients informed and moving.', 'memphislaw'); ?></p>
            </div>

            <div class="practice-process__steps">
                <?php foreach ($practice_area['process_steps'] as $index => $step) : ?>
                    <article class="practice-step-card">
                        <p class="practice-step-card__index"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></p>
                        <h3><?php echo esc_html($step['title']); ?></h3>
                        <p><?php echo esc_html($step['summary']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--dark">
        <div class="container practice-cta">
            <div class="practice-cta__panel">
                <p class="eyebrow"><?php esc_html_e('Talk With Us', 'memphislaw'); ?></p>
                <h2><?php echo esc_html($practice_area['cta_title']); ?></h2>
                <p><?php echo esc_html($practice_area['cta_copy']); ?></p>
                <div class="hero__actions">
                    <a class="button" href="<?php echo esc_url(memphislaw_get_consultation_url()); ?>">
                        <?php esc_html_e('Start the Conversation', 'memphislaw'); ?>
                    </a>
                    <a class="button button--ghost" href="<?php echo esc_url(memphislaw_get_phone_href()); ?>">
                        <?php echo esc_html($contact['phone']); ?>
                    </a>
                </div>
            </div>

            <div class="practice-cta__related">
                <p class="eyebrow"><?php esc_html_e('Related Services', 'memphislaw'); ?></p>
                <div class="practice-related-grid">
                    <?php foreach ($related_areas as $related_area) : ?>
                        <article class="practice-related-card">
                            <h3><?php echo esc_html($related_area['title']); ?></h3>
                            <p><?php echo esc_html($related_area['summary']); ?></p>
                            <a href="<?php echo esc_url($related_area['link']); ?>"><?php esc_html_e('Explore This Practice Area', 'memphislaw'); ?></a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</main>
