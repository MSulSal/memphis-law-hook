<?php
declare(strict_types=1);

get_header();

$practice_areas = memphislaw_get_practice_areas();
$benefits = memphislaw_get_workers_comp_benefits();
$steps = memphislaw_get_workers_comp_steps();
$attorneys = memphislaw_get_attorneys();
$stats = memphislaw_get_site_stats();
$testimonials = memphislaw_get_testimonials();
$contact = memphislaw_get_contact_details();
$hero = memphislaw_get_homepage_hero_content();
$hero_image_url = memphislaw_get_homepage_hero_image_url();
$sections = memphislaw_get_homepage_sections();
?>
<main id="primary" class="site-main memphis-law-page">
    <section class="hero ml-hero" id="top">
        <div class="hero__media" aria-hidden="true">
            <img src="<?php echo esc_url($hero_image_url); ?>" alt="">
        </div>
        <div class="hero__wash" aria-hidden="true"></div>
        <div class="hero__glow" aria-hidden="true"></div>
        <div class="container hero__inner ml-hero-inner ml-container">
            <div class="hero__panel ml-hero-copy">
                <p class="hero__pill ml-eyebrow-pill">
                    <span><?php echo esc_html($hero['pill_location']); ?></span>
                    <span aria-hidden="true">&bull;</span>
                    <span><?php echo esc_html($hero['pill_since']); ?></span>
                </p>
                <h1 class="hero__title ml-hero-title">
                    <span class="hero__title-line"><?php echo esc_html($hero['title_lines'][0]); ?></span>
                    <span class="hero__title-line"><?php echo esc_html($hero['title_lines'][1]); ?></span>
                    <span class="hero__title-line hero__title-line--accent"><?php echo esc_html($hero['title_lines'][2]); ?></span>
                    <span class="hero__title-line hero__title-line--accent"><?php echo esc_html($hero['title_lines'][3]); ?></span>
                </h1>
                <div class="hero__summary">
                    <p class="hero__practice-line ml-hero-subline">
                        <span><?php echo esc_html($hero['practice_areas'][0]); ?></span>
                        <span aria-hidden="true">&bull;</span>
                        <span><?php echo esc_html($hero['practice_areas'][1]); ?></span>
                        <span aria-hidden="true">&bull;</span>
                    </p>
                    <p class="hero__practice-line ml-hero-subline"><?php echo esc_html($hero['practice_areas'][2]); ?></p>
                    <p class="hero__support-line ml-hero-text"><?php echo esc_html($hero['support_lines'][0]); ?></p>
                    <p class="hero__support-line ml-hero-text"><?php echo esc_html($hero['support_lines'][1]); ?></p>
                </div>
                <div class="hero__actions ml-hero-actions">
                    <a class="button ml-btn-primary" href="<?php echo esc_url($hero['primary_button_url']); ?>">
                        <?php echo esc_html($hero['primary_button_label']); ?>
                    </a>
                    <a class="button button--ghost button--phone ml-btn-outline" href="<?php echo esc_url($hero['secondary_button_url']); ?>">
                        <span class="button__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('contact-phone'); ?></span>
                        <span><?php echo esc_html($hero['secondary_button_label']); ?></span>
                    </a>
                </div>

                <div class="hero__metrics ml-hero-stats" aria-label="<?php esc_attr_e('Firm highlights', 'memphislaw'); ?>">
                    <?php foreach ($hero['metrics'] as $metric) : ?>
                        <div class="hero__metric">
                            <strong class="ml-hero-stat-number"><?php echo esc_html($metric['value']); ?></strong>
                            <span class="ml-hero-stat-label"><?php echo esc_html($metric['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--dark ml-practice" id="practice-areas">
        <div class="container ml-container">
            <div class="section__intro">
                <p class="eyebrow"><?php echo esc_html($sections['practice']['eyebrow']); ?></p>
                <h2><?php echo esc_html($sections['practice']['title']); ?></h2>
                <p><?php echo esc_html($sections['practice']['intro']); ?></p>
            </div>

            <div class="card-grid ml-practice-grid">
                <?php foreach ($practice_areas as $area) : ?>
                    <article class="service-card ml-service-card" id="<?php echo esc_attr($area['id']); ?>">
                        <div class="service-card__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup((string) $area['icon']); ?></div>
                        <h3><?php echo esc_html($area['title']); ?></h3>
                        <p><?php echo esc_html($area['summary']); ?></p>
                        <ul>
                            <?php foreach ($area['bullets'] as $bullet) : ?>
                                <li><?php echo esc_html($bullet); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo esc_url($area['link']); ?>">
                            <span><?php esc_html_e('Discuss Your Case', 'memphislaw'); ?></span>
                            <span class="service-card__link-icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('button-arrow'); ?></span>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--blue ml-workers" id="workers-comp">
        <div class="container workers-comp ml-workers-grid ml-container">
            <div class="workers-comp__main">
                <p class="eyebrow"><?php echo esc_html($sections['workers_comp']['eyebrow']); ?></p>
                <h2><?php echo esc_html($sections['workers_comp']['title']); ?></h2>
                <p>
                    <?php echo esc_html($sections['workers_comp']['intro']); ?>
                </p>

                <div class="workers-comp__split">
                    <div>
                        <h3><?php echo esc_html($sections['workers_comp']['covered_heading']); ?></h3>
                        <p><?php echo esc_html($sections['workers_comp']['covered_copy']); ?></p>
                    </div>
                </div>

                <h3><?php echo esc_html($sections['workers_comp']['benefits_heading']); ?></h3>
                <div class="benefit-grid ml-benefits-grid">
                    <?php foreach ($benefits as $benefit) : ?>
                        <article class="benefit-card">
                            <div class="benefit-card__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup((string) $benefit['icon']); ?></div>
                            <div>
                                <h4><?php echo esc_html($benefit['title']); ?></h4>
                                <p><?php echo esc_html($benefit['summary']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="deadline-note">
                    <strong><?php echo esc_html($sections['workers_comp']['deadline_label']); ?></strong>
                    <span><?php echo esc_html($sections['workers_comp']['deadline_copy']); ?></span>
                </div>
            </div>

            <div class="workers-comp__side">
                <aside class="info-card">
                    <h3><?php echo esc_html($sections['workers_comp']['denied_title']); ?></h3>
                    <p><?php echo esc_html($sections['workers_comp']['denied_copy']); ?></p>
                    <a class="button" href="<?php echo esc_url(memphislaw_get_page_url_by_path('workers-compensation', home_url('/#workers-comp'))); ?>"><?php echo esc_html($sections['workers_comp']['denied_button_label']); ?></a>
                    <a class="info-card__phone" href="<?php echo esc_url(memphislaw_get_phone_href()); ?>"><?php echo esc_html($contact['phone']); ?></a>
                </aside>

                <aside class="steps-card">
                    <p class="eyebrow"><?php echo esc_html($sections['workers_comp']['steps_eyebrow']); ?></p>
                    <ol>
                        <?php foreach ($steps as $step) : ?>
                            <li>
                                <strong><?php echo esc_html($step['title']); ?></strong>
                                <span>&mdash; <?php echo esc_html((string) $step['summary']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </aside>
            </div>
        </div>
    </section>

    <section class="section section--dark ml-team" id="team">
        <div class="container ml-container">
            <div class="section__intro">
                <p class="eyebrow"><?php echo esc_html($sections['team']['eyebrow']); ?></p>
                <h2><?php echo esc_html($sections['team']['title']); ?></h2>
                <p><?php echo esc_html($sections['team']['intro']); ?></p>
            </div>

            <div class="attorney-grid ml-attorney-grid">
                <?php foreach ($attorneys as $attorney) : ?>
                    <article class="attorney-card ml-attorney-card">
                        <div class="attorney-card__meta">
                            <div class="attorney-card__avatar" aria-hidden="true"><?php echo memphislaw_get_icon_markup('attorney-avatar'); ?></div>
                            <?php if (!empty($attorney['badge'])) : ?>
                                <p class="attorney-card__badge"><?php echo esc_html($attorney['badge']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="attorney-card__body">
                            <h3><?php echo esc_html($attorney['name']); ?></h3>
                            <p class="attorney-card__role"><?php echo esc_html($attorney['role']); ?></p>
                            <p><?php echo esc_html($attorney['summary']); ?></p>
                            <?php if (!empty($attorney['credentials'])) : ?>
                                <ul class="attorney-card__credentials">
                                    <?php foreach ($attorney['credentials'] as $credential) : ?>
                                        <li><?php echo esc_html($credential); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="stat-grid ml-stats-row">
                <?php foreach ($stats as $stat) : ?>
                    <article class="stat-card ml-stat-card">
                        <strong><?php echo esc_html($stat['value']); ?></strong>
                        <span><?php echo esc_html($stat['label']); ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--dark section--testimonials ml-testimonials" id="testimonials">
        <div class="container ml-container">
            <div class="section__intro">
                <p class="eyebrow"><?php echo esc_html($sections['testimonials']['eyebrow']); ?></p>
                <h2><?php echo esc_html($sections['testimonials']['title']); ?></h2>
            </div>

            <div class="testimonial-grid ml-testimonial-grid">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <article class="testimonial-card ml-testimonial-card">
                        <p class="testimonial-card__rating" aria-label="<?php echo esc_attr(sprintf(__('%d out of 5 stars', 'memphislaw'), $testimonial['rating'])); ?>">
                            <?php echo wp_kses_post(str_repeat('&#9733;', (int) $testimonial['rating'])); ?>
                        </p>
                        <blockquote><?php echo esc_html($testimonial['quote']); ?></blockquote>
                        <p class="testimonial-card__client">&mdash; <?php echo esc_html($testimonial['client']); ?></p>
                        <p class="testimonial-card__matter"><?php echo esc_html($testimonial['matter']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--blue ml-contact" id="consultation">
        <div class="container consultation ml-contact-grid ml-container">
            <div class="consultation__details">
                <p class="eyebrow"><?php echo esc_html($sections['consultation']['eyebrow']); ?></p>
                <h2><?php echo esc_html($sections['consultation']['title']); ?></h2>
                <p><?php echo esc_html($sections['consultation']['intro']); ?></p>

                <dl class="contact-list">
                    <div>
                        <dt>
                            <span class="contact-list__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('contact-address'); ?></span>
                            <span><?php esc_html_e('Address', 'memphislaw'); ?></span>
                        </dt>
                        <dd><?php echo esc_html($contact['address_line_1']); ?><br><?php echo esc_html($contact['address_line_2']); ?></dd>
                    </div>
                    <div>
                        <dt>
                            <span class="contact-list__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('contact-phone'); ?></span>
                            <span><?php esc_html_e('Phone', 'memphislaw'); ?></span>
                        </dt>
                        <dd><a href="<?php echo esc_url(memphislaw_get_phone_href()); ?>"><?php echo esc_html($contact['phone']); ?></a></dd>
                    </div>
                    <div>
                        <dt>
                            <span class="contact-list__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('contact-email'); ?></span>
                            <span><?php esc_html_e('Email', 'memphislaw'); ?></span>
                        </dt>
                        <dd><a href="mailto:<?php echo antispambot(esc_attr($contact['email'])); ?>"><?php echo esc_html(antispambot($contact['email'])); ?></a></dd>
                    </div>
                    <div>
                        <dt>
                            <span class="contact-list__icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('contact-hours'); ?></span>
                            <span><?php esc_html_e('Office Hours', 'memphislaw'); ?></span>
                        </dt>
                        <dd><?php echo nl2br(esc_html($contact['hours'])); ?></dd>
                    </div>
                </dl>

                <div class="consultation__map ml-map">
                    <?php echo memphislaw_render_consultation_map(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
            </div>

            <div class="consultation__form">
                <?php echo memphislaw_render_consultation_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
