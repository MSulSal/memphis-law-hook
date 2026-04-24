<?php
declare(strict_types=1);

$contact = memphislaw_get_contact_details();
$brand = memphislaw_get_brand_settings();
?>
<footer class="site-footer">
    <div class="container site-footer__grid">
        <div>
            <a class="brand brand--footer" href="<?php echo esc_url(home_url('/')); ?>">
                <span class="brand__mark" aria-hidden="true"><?php echo wp_kses_post(memphislaw_get_brand_logo_markup()); ?></span>
                <span class="brand__text">
                    <strong>Arthur Ray</strong>
                    <span><?php esc_html_e('Law Offices', 'memphislaw'); ?></span>
                </span>
            </a>
            <p class="site-footer__blurb">
                <?php echo esc_html($brand['tagline']); ?>
            </p>
        </div>

        <div>
            <h2 class="site-footer__heading"><?php esc_html_e('Practice Areas', 'memphislaw'); ?></h2>
            <ul class="site-footer__list">
                <?php foreach (memphislaw_get_practice_areas() as $area) : ?>
                    <li><a href="<?php echo esc_url($area['link']); ?>"><?php echo esc_html($area['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <h2 class="site-footer__heading"><?php esc_html_e('Firm', 'memphislaw'); ?></h2>
            <ul class="site-footer__list">
                <li><a href="<?php echo esc_url(home_url('/#team')); ?>"><?php esc_html_e('Our Attorneys', 'memphislaw'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#testimonials')); ?>"><?php esc_html_e('Client Testimonials', 'memphislaw'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#consultation')); ?>"><?php esc_html_e('Contact Us', 'memphislaw'); ?></a></li>
            </ul>
        </div>

        <div>
            <h2 class="site-footer__heading"><?php esc_html_e('Contact', 'memphislaw'); ?></h2>
            <ul class="site-footer__list">
                <li><?php echo esc_html($contact['address_line_1']); ?></li>
                <li><?php echo esc_html($contact['address_line_2']); ?></li>
                <li><a href="<?php echo esc_url(memphislaw_get_phone_href()); ?>"><?php echo esc_html($contact['phone']); ?></a></li>
                <li><a href="mailto:<?php echo antispambot(esc_attr($contact['email'])); ?>"><?php echo esc_html(antispambot($contact['email'])); ?></a></li>
            </ul>
        </div>
    </div>

    <div class="container site-footer__legal">
        <p>&copy; <?php echo esc_html(date_i18n('Y')); ?> Arthur Ray Law Offices, PLLC. <?php esc_html_e('All rights reserved.', 'memphislaw'); ?></p>
        <p><?php echo esc_html($brand['footer_disclaimer']); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
