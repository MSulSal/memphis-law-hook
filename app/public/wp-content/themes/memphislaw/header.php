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
                <span class="site-header__phone-icon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('contact-phone'); ?></span>
                <?php echo esc_html($contact['phone']); ?>
            </a>
            <a class="button button--small site-header__cta" href="<?php echo esc_url(home_url('/#consultation')); ?>">
                <?php echo esc_html($brand['header_consultation_label']); ?>
            </a>
            <button class="site-header__theme-toggle" type="button" aria-pressed="false" aria-label="<?php esc_attr_e('Toggle light and dark theme', 'memphislaw'); ?>" data-theme-toggle>
                <span class="site-header__theme-icon site-header__theme-icon--moon" aria-hidden="true"><?php echo memphislaw_get_icon_markup('theme-toggle'); ?></span>
                <span class="site-header__theme-icon site-header__theme-icon--sun" aria-hidden="true"><?php echo memphislaw_get_icon_markup('theme-sun'); ?></span>
            </button>
        </div>
    </div>
</header>
