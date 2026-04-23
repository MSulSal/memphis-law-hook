<?php
declare(strict_types=1);

require_once __DIR__ . '/inc/site-data.php';
require_once __DIR__ . '/inc/customizer.php';

function memphislaw_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support(
        'html5',
        [
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        ]
    );

    register_nav_menus(
        [
            'primary' => __('Primary Navigation', 'memphislaw'),
        ]
    );
}
add_action('after_setup_theme', 'memphislaw_setup');

function memphislaw_enqueue_assets(): void
{
    $theme = wp_get_theme();
    $version = $theme->get('Version') ?: '0.1.0';

    wp_enqueue_style(
        'memphislaw-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,600;1,700;1,800&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'memphislaw-theme',
        get_theme_file_uri('/assets/css/site.css'),
        ['memphislaw-fonts'],
        $version
    );

    wp_add_inline_style('memphislaw-theme', memphislaw_get_dynamic_styles());

    wp_enqueue_script(
        'memphislaw-theme',
        get_theme_file_uri('/assets/js/site.js'),
        [],
        $version,
        true
    );
}
add_action('wp_enqueue_scripts', 'memphislaw_enqueue_assets');

function memphislaw_render_fallback_menu(): void
{
    echo '<ul class="menu">';

    foreach (memphislaw_get_primary_navigation_items() as $item) {
        printf(
            '<li class="menu-item"><a href="%1$s">%2$s</a></li>',
            esc_url($item['url']),
            esc_html($item['label'])
        );
    }

    echo '</ul>';
}

function memphislaw_render_consultation_form(): string
{
    if (shortcode_exists('memphislaw_consultation_form')) {
        return do_shortcode('[memphislaw_consultation_form]');
    }

    return '<div class="consultation-form consultation-form--fallback"><p>' .
        esc_html__('Activate the Memphis Law Core plugin to enable consultation requests.', 'memphislaw') .
        '</p></div>';
}

function memphislaw_get_phone_href(): string
{
    return 'tel:' . preg_replace('/[^0-9+]/', '', memphislaw_get_contact_details()['phone']);
}
