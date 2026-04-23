<?php
declare(strict_types=1);

$contact = memphislaw_get_contact_details();
?>
<footer class="site-footer">
    <div class="container site-footer__grid">
        <div>
            <a class="brand brand--footer" href="<?php echo esc_url(home_url('/')); ?>">
                <span class="brand__mark" aria-hidden="true">A</span>
                <span class="brand__text">
                    <strong>Arthur Ray</strong>
                    <span><?php esc_html_e('Law Offices', 'memphislaw'); ?></span>
                </span>
            </a>
            <p class="site-footer__blurb">
                <?php esc_html_e('Trusted legal counsel for Memphis families since 1974.', 'memphislaw'); ?>
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
                <?php foreach (memphislaw_get_primary_navigation_items() as $item) : ?>
                    <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
                <?php endforeach; ?>
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
        <p><?php esc_html_e('Attorney advertising. This website is for general information only and does not create an attorney-client relationship.', 'memphislaw'); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
