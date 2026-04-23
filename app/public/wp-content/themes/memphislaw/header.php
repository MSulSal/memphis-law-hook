<?php
declare(strict_types=1);

$contact = memphislaw_get_contact_details();
$brand = memphislaw_get_brand_settings();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#primary"><?php esc_html_e('Skip to content', 'memphislaw'); ?></a>
<header class="site-header">
    <div class="container site-header__inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="brand__mark" aria-hidden="true"><?php echo wp_kses_post(memphislaw_get_brand_logo_markup()); ?></span>
            <span class="brand__text">
                <strong>Arthur Ray</strong>
                <span class="brand__subline"><?php esc_html_e('Law Offices', 'memphislaw'); ?></span>
            </span>
        </a>

        <button
            class="site-header__toggle"
            type="button"
            aria-expanded="false"
            aria-controls="site-navigation"
            data-nav-toggle
        >
            <span></span>
            <span></span>
            <span></span>
            <span class="screen-reader-text"><?php esc_html_e('Toggle navigation', 'memphislaw'); ?></span>
        </button>

        <nav class="site-header__nav" id="site-navigation" aria-label="<?php esc_attr_e('Primary navigation', 'memphislaw'); ?>" data-nav-panel>
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(
                    [
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'menu',
                        'fallback_cb'    => false,
                    ]
                );
            } else {
                memphislaw_render_fallback_menu();
            }
            ?>
        </nav>

        <div class="site-header__actions">
            <a class="site-header__phone" href="<?php echo esc_url(memphislaw_get_phone_href()); ?>">
                <svg class="site-header__phone-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M7.6 10.8a15 15 0 0 0 5.6 5.6l1.9-1.9a1.2 1.2 0 0 1 1.2-.3c1 .3 2 .5 3.1.5a1.2 1.2 0 0 1 1.2 1.2V19a1.2 1.2 0 0 1-1.2 1.2C10.5 20.2 3.8 13.5 3.8 5.2A1.2 1.2 0 0 1 5 4h3.1a1.2 1.2 0 0 1 1.2 1.2c0 1.1.2 2.1.5 3.1a1.2 1.2 0 0 1-.3 1.2l-1.9 1.3Z" fill="currentColor"/>
                </svg>
                <?php echo esc_html($contact['phone']); ?>
            </a>
            <a class="button button--small site-header__cta" href="<?php echo esc_url(home_url('/#consultation')); ?>">
                <?php echo esc_html($brand['header_consultation_label']); ?>
            </a>
            <span class="site-header__utility" aria-hidden="true">
                <svg class="site-header__utility-icon" viewBox="0 0 24 24" focusable="false">
                    <path d="M14.7 3.5a8.8 8.8 0 1 0 5.8 15.4 7.4 7.4 0 1 1-5.8-15.4Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </div>
    </div>
</header>
