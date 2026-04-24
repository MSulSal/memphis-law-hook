<?php
declare(strict_types=1);

require_once __DIR__ . '/inc/site-data.php';
require_once __DIR__ . '/inc/customizer.php';

function memphislaw_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support(
        'custom-logo',
        [
            'height' => 96,
            'width' => 96,
            'flex-height' => true,
            'flex-width' => true,
        ]
    );
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

    add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'memphislaw_setup');

function memphislaw_enqueue_assets(): void
{
    $theme = wp_get_theme();
    $version = $theme->get('Version') ?: '0.1.0';
    $style_path = get_theme_file_path('/assets/css/site.css');
    $script_path = get_theme_file_path('/assets/js/site.js');
    $style_version = file_exists($style_path) ? (string) filemtime($style_path) : $version;
    $script_version = file_exists($script_path) ? (string) filemtime($script_path) : $version;

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
        $style_version
    );

    wp_add_inline_style('memphislaw-theme', memphislaw_get_dynamic_styles());

    wp_enqueue_script(
        'memphislaw-theme',
        get_theme_file_uri('/assets/js/site.js'),
        [],
        $script_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'memphislaw_enqueue_assets');

function memphislaw_output_theme_bootstrap_script(): void
{
    ?>
    <script>
        (function () {
            try {
                var previewTheme = new URLSearchParams(window.location.search).get('theme');
                if (previewTheme === 'light' || previewTheme === 'dark') {
                    document.documentElement.dataset.theme = previewTheme;
                    return;
                }

                var savedTheme = localStorage.getItem('memphislaw-theme');
                if (savedTheme === 'light' || savedTheme === 'dark') {
                    document.documentElement.dataset.theme = savedTheme;
                }
            } catch (error) {
                return;
            }
        }());
    </script>
    <?php
}
add_action('wp_head', 'memphislaw_output_theme_bootstrap_script', 0);

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

function memphislaw_render_consultation_map(): string
{
    if (function_exists('memphislaw_google_maps_render_map')) {
        return memphislaw_google_maps_render_map(
            [
                'class_name' => 'consultation__map-embed',
                'title' => __('Arthur Ray Law Offices location map', 'memphislaw'),
            ]
        );
    }

    return '<div class="consultation__map-fallback"><p>' .
        esc_html__('Activate the Memphis Law Google Maps plugin to display the live office map.', 'memphislaw') .
        '</p></div>';
}

function memphislaw_get_phone_href(): string
{
    return 'tel:' . preg_replace('/[^0-9+]/', '', memphislaw_get_contact_details()['phone']);
}

function memphislaw_get_brand_logo_markup(): string
{
    $logo_id = (int) get_theme_mod('custom_logo');

    if ($logo_id > 0) {
        $markup = wp_get_attachment_image(
            $logo_id,
            'full',
            false,
            [
                'class' => 'brand__image',
                'loading' => 'eager',
                'alt' => get_bloginfo('name'),
            ]
        );

        if (is_string($markup) && $markup !== '') {
            return $markup;
        }
    }

    return sprintf(
        '<img class="brand__image" src="%1$s" alt="%2$s" loading="eager">',
        esc_url(get_theme_file_uri('/assets/images/logo-nobg.png')),
        esc_attr(get_bloginfo('name'))
    );
}

function memphislaw_get_svg_allowed_html(): array
{
    return [
        'svg' => [
            'aria-hidden' => true,
            'class' => true,
            'focusable' => true,
            'viewBox' => true,
            'viewbox' => true,
            'xmlns' => true,
        ],
        'path' => [
            'd' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'stroke-width' => true,
        ],
        'rect' => [
            'fill' => true,
            'height' => true,
            'rx' => true,
            'stroke' => true,
            'stroke-width' => true,
            'width' => true,
            'x' => true,
            'y' => true,
        ],
        'circle' => [
            'cx' => true,
            'cy' => true,
            'fill' => true,
            'r' => true,
            'stroke' => true,
            'stroke-width' => true,
        ],
    ];
}

function memphislaw_get_icon_svg(string $icon): string
{
    return match ($icon) {
        'service-bankruptcy', 'B' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4.5" y="5.5" width="15" height="10" rx="2.2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M8 9.5h8M8 12.5h5.5M10 18.5h4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M12 15.5v3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'service-personal-injury', 'P' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 3.8l6.3 2.4v4.9c0 4.2-2.6 7.9-6.3 9.1-3.7-1.2-6.3-4.9-6.3-9.1V6.2L12 3.8Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M12 8.2v6.6M8.7 11.5H15.3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'service-workers-compensation', 'W' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M8.5 10.2a2.7 2.7 0 1 0 0-5.4 2.7 2.7 0 0 0 0 5.4ZM15.8 9.4a2.1 2.1 0 1 0 0-4.2 2.1 2.1 0 0 0 0 4.2ZM4.8 18.7v-1.1a3.5 3.5 0 0 1 3.5-3.5h.5a3.5 3.5 0 0 1 3.5 3.5v1.1M13.1 18v-.9a2.9 2.9 0 0 1 2.9-2.9h.3a2.9 2.9 0 0 1 2.9 2.9v.9" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'benefit-medical' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4.5" y="7.2" width="15" height="11.3" rx="2.1" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M9.2 5.8v2.4M14.8 5.8v2.4M12 10v5.2M9.4 12.6h5.2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'benefit-wage' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 8.3h14v7.8a2.2 2.2 0 0 1-2.2 2.2H7.2A2.2 2.2 0 0 1 5 16.1V8.3Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M7.3 6.1h9.4a1.3 1.3 0 0 1 1.3 1.3v.9H6v-.9a1.3 1.3 0 0 1 1.3-1.3ZM9.2 12.2h5.6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'benefit-disability' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="7.2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 8.4v4l2.8 1.9" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'benefit-vocational' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4.8 10.4 12 5l7.2 5.4M6.4 9.7v8.3h11.2V9.7M9.3 18v-4.4h5.4V18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'benefit-death' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 6.5c1.2-1.8 4.6-1.9 5.9.5 1 1.8.3 4-1.2 5.4L12 17l-4.7-4.6C5.8 11 5.1 8.8 6.1 7c1.3-2.4 4.7-2.3 5.9-.5Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>',
        'benefit-retaliation' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 3.8l6.3 2.4v4.9c0 4.2-2.6 7.9-6.3 9.1-3.7-1.2-6.3-4.9-6.3-9.1V6.2L12 3.8Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 12.2 10.9 14l4.1-4.2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'contact-address' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 20s5.4-5.2 5.4-9.5A5.4 5.4 0 1 0 6.6 10.5C6.6 14.8 12 20 12 20Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><circle cx="12" cy="10.2" r="1.8" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>',
        'contact-phone' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7.6 10.8a15 15 0 0 0 5.6 5.6l1.9-1.9a1.2 1.2 0 0 1 1.2-.3c1 .3 2 .5 3.1.5a1.2 1.2 0 0 1 1.2 1.2V19a1.2 1.2 0 0 1-1.2 1.2C10.5 20.2 3.8 13.5 3.8 5.2A1.2 1.2 0 0 1 5 4h3.1a1.2 1.2 0 0 1 1.2 1.2c0 1.1.2 2.1.5 3.1a1.2 1.2 0 0 1-.3 1.2l-1.9 1.3Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'contact-email' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4.5" y="6.5" width="15" height="11" rx="2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m6.5 8.5 5.5 4.4 5.5-4.4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'contact-hours' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="7.2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 8.3v4.2l2.8 1.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'attorney-avatar' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 11.1a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4ZM6.3 18.7v-1.1a5.7 5.7 0 0 1 11.4 0v1.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'theme-toggle' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M14.7 3.5a8.8 8.8 0 1 0 5.8 15.4 7.4 7.4 0 1 1-5.8-15.4Z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'theme-sun' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="3.8" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 3.5v2.2M12 18.3v2.2M20.5 12h-2.2M5.7 12H3.5M18 6l-1.5 1.5M7.5 16.5 6 18M18 18l-1.5-1.5M7.5 7.5 6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'button-arrow' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 12h13M12 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        default => '',
    };
}

function memphislaw_get_icon_markup(string $icon): string
{
    return wp_kses(memphislaw_get_icon_svg($icon), memphislaw_get_svg_allowed_html());
}
