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
?>
<main id="primary" class="site-main">
    <section class="hero" id="top">
        <div class="hero__overlay"></div>
        <div class="container hero__inner">
            <div class="hero__content">
                <p class="eyebrow"><?php esc_html_e('Memphis, Tennessee • Since 1974', 'memphislaw'); ?></p>
                <h1 class="hero__title">
                    <?php esc_html_e('Trusted Legal Counsel', 'memphislaw'); ?>
                    <span><?php esc_html_e('When It Matters Most', 'memphislaw'); ?></span>
                </h1>
                <p class="hero__lead">
                    <?php esc_html_e("Bankruptcy, personal injury, and workers' compensation representation for Memphis families and Mid-South workers.", 'memphislaw'); ?>
                </p>
                <div class="hero__actions">
                    <a class="button" href="<?php echo esc_url(home_url('/#consultation')); ?>">
                        <?php esc_html_e('Get a Free Consultation', 'memphislaw'); ?>
                    </a>
                    <a class="button button--ghost" href="<?php echo esc_url(memphislaw_get_phone_href()); ?>">
                        <?php echo esc_html(sprintf(__('Call %s', 'memphislaw'), $contact['phone'])); ?>
                    </a>
                </div>

                <div class="hero__stats">
                    <?php foreach (array_slice($stats, 0, 3) as $stat) : ?>
                        <div class="hero__stat">
                            <strong><?php echo esc_html($stat['value']); ?></strong>
                            <span><?php echo esc_html($stat['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--dark" id="practice-areas">
        <div class="container">
            <div class="section__intro">
                <p class="eyebrow"><?php esc_html_e('Practice Areas', 'memphislaw'); ?></p>
                <h2><?php esc_html_e('Comprehensive Legal Services for Memphis Families', 'memphislaw'); ?></h2>
                <p><?php esc_html_e("Whether you're facing financial hardship, recovering from an injury, or navigating a workplace accident, Arthur Ray Law Offices provides experienced, compassionate representation.", 'memphislaw'); ?></p>
            </div>

            <div class="card-grid">
                <?php foreach ($practice_areas as $area) : ?>
                    <article class="service-card" id="<?php echo esc_attr($area['id']); ?>">
                        <div class="service-card__icon" aria-hidden="true"><?php echo esc_html($area['icon']); ?></div>
                        <h3><?php echo esc_html($area['title']); ?></h3>
                        <p><?php echo esc_html($area['summary']); ?></p>
                        <ul>
                            <?php foreach ($area['bullets'] as $bullet) : ?>
                                <li><?php echo esc_html($bullet); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo esc_url($area['link']); ?>"><?php esc_html_e('Discuss Your Case', 'memphislaw'); ?></a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--blue" id="workers-comp">
        <div class="container workers-comp">
            <div class="workers-comp__main">
                <p class="eyebrow"><?php esc_html_e('Tennessee Law', 'memphislaw'); ?></p>
                <h2><?php esc_html_e("Workers' Compensation in Tennessee: Know Your Rights", 'memphislaw'); ?></h2>
                <p>
                    <?php esc_html_e("Tennessee's workers' compensation system provides important protections for employees injured on the job. Understanding your eligibility and benefits is the first step toward recovery.", 'memphislaw'); ?>
                </p>

                <div class="workers-comp__split">
                    <div>
                        <h3><?php esc_html_e('Who Is Covered?', 'memphislaw'); ?></h3>
                        <p><?php esc_html_e("Under Tennessee Code Annotated § 50-6-102, employers with five or more employees are required to carry workers' compensation insurance. This coverage protects employees in virtually all industries.", 'memphislaw'); ?></p>
                    </div>
                    <aside class="info-card">
                        <h3><?php esc_html_e('Was Your Claim Denied?', 'memphislaw'); ?></h3>
                        <p><?php esc_html_e('Insurance companies often deny valid claims. We fight back at no cost unless you win.', 'memphislaw'); ?></p>
                        <a class="button" href="<?php echo esc_url(home_url('/#consultation')); ?>"><?php esc_html_e('Get Help Now', 'memphislaw'); ?></a>
                        <a class="info-card__phone" href="<?php echo esc_url(memphislaw_get_phone_href()); ?>"><?php echo esc_html($contact['phone']); ?></a>
                    </aside>
                </div>

                <h3><?php esc_html_e('What Benefits Are Available?', 'memphislaw'); ?></h3>
                <div class="benefit-grid">
                    <?php foreach ($benefits as $benefit) : ?>
                        <article class="benefit-card">
                            <div class="benefit-card__icon" aria-hidden="true"><?php echo esc_html($benefit['icon']); ?></div>
                            <div>
                                <h4><?php echo esc_html($benefit['title']); ?></h4>
                                <p><?php echo esc_html($benefit['summary']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="deadline-note">
                    <strong><?php esc_html_e('Important deadline:', 'memphislaw'); ?></strong>
                    <span><?php esc_html_e("You must report your injury quickly and file your claim within the required time. Don't wait to ask for guidance.", 'memphislaw'); ?></span>
                </div>
            </div>

            <aside class="steps-card">
                <p class="eyebrow"><?php esc_html_e('Steps After a Work Injury', 'memphislaw'); ?></p>
                <ol>
                    <?php foreach ($steps as $step) : ?>
                        <li>
                            <strong><?php echo esc_html($step['title']); ?></strong>
                            <span><?php echo esc_html($step['summary']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </aside>
        </div>
    </section>

    <section class="section section--dark" id="team">
        <div class="container">
            <div class="section__intro">
                <p class="eyebrow"><?php esc_html_e('Our Team', 'memphislaw'); ?></p>
                <h2><?php esc_html_e('Experience You Can Trust', 'memphislaw'); ?></h2>
                <p><?php esc_html_e('The attorneys at Arthur Ray Law Offices bring decades of combined experience and a genuine commitment to the people of Memphis and surrounding communities.', 'memphislaw'); ?></p>
            </div>

            <div class="attorney-grid">
                <?php foreach ($attorneys as $attorney) : ?>
                    <article class="attorney-card">
                        <div class="attorney-card__avatar" aria-hidden="true"><?php echo esc_html($attorney['initials']); ?></div>
                        <div class="attorney-card__body">
                            <h3><?php echo esc_html($attorney['name']); ?></h3>
                            <p class="attorney-card__role"><?php echo esc_html($attorney['role']); ?></p>
                            <?php if (!empty($attorney['badge'])) : ?>
                                <p class="attorney-card__badge"><?php echo esc_html($attorney['badge']); ?></p>
                            <?php endif; ?>
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

            <div class="stat-grid">
                <?php foreach ($stats as $stat) : ?>
                    <article class="stat-card">
                        <strong><?php echo esc_html($stat['value']); ?></strong>
                        <span><?php echo esc_html($stat['label']); ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--dark section--testimonials" id="testimonials">
        <div class="container">
            <div class="section__intro">
                <p class="eyebrow"><?php esc_html_e('Client Stories', 'memphislaw'); ?></p>
                <h2><?php esc_html_e('What Our Clients Say', 'memphislaw'); ?></h2>
            </div>

            <div class="testimonial-grid">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <article class="testimonial-card">
                        <p class="testimonial-card__rating" aria-label="<?php echo esc_attr(sprintf(__('%d out of 5 stars', 'memphislaw'), $testimonial['rating'])); ?>">
                            <?php echo esc_html(str_repeat('★', (int) $testimonial['rating'])); ?>
                        </p>
                        <blockquote><?php echo esc_html($testimonial['quote']); ?></blockquote>
                        <p class="testimonial-card__client"><?php echo esc_html($testimonial['client']); ?></p>
                        <p class="testimonial-card__matter"><?php echo esc_html($testimonial['matter']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section--blue" id="consultation">
        <div class="container consultation">
            <div class="consultation__details">
                <p class="eyebrow"><?php esc_html_e('Get in Touch', 'memphislaw'); ?></p>
                <h2><?php esc_html_e('Free Consultation. No Fees Unless You Win.', 'memphislaw'); ?></h2>
                <p><?php esc_html_e("Tell us about your situation. We'll review your case at no charge and advise you on the strongest next step.", 'memphislaw'); ?></p>

                <dl class="contact-list">
                    <div>
                        <dt><?php esc_html_e('Address', 'memphislaw'); ?></dt>
                        <dd><?php echo esc_html($contact['address_line_1']); ?><br><?php echo esc_html($contact['address_line_2']); ?></dd>
                    </div>
                    <div>
                        <dt><?php esc_html_e('Phone', 'memphislaw'); ?></dt>
                        <dd><a href="<?php echo esc_url(memphislaw_get_phone_href()); ?>"><?php echo esc_html($contact['phone']); ?></a></dd>
                    </div>
                    <div>
                        <dt><?php esc_html_e('Email', 'memphislaw'); ?></dt>
                        <dd><a href="mailto:<?php echo antispambot(esc_attr($contact['email'])); ?>"><?php echo esc_html(antispambot($contact['email'])); ?></a></dd>
                    </div>
                    <div>
                        <dt><?php esc_html_e('Office Hours', 'memphislaw'); ?></dt>
                        <dd><?php echo esc_html($contact['hours']); ?></dd>
                    </div>
                </dl>

                <div class="consultation__map">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/office-map.jpg')); ?>" alt="<?php esc_attr_e('Map showing the office area around Arthur Ray Law Offices in Memphis.', 'memphislaw'); ?>">
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
